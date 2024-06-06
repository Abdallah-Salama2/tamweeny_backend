import pandas as pd
import numpy as np
from sklearn.feature_extraction.text import TfidfVectorizer
from sklearn.metrics.pairwise import cosine_similarity
from sklearn.preprocessing import MinMaxScaler
import json
import sys
import os

print("Script started")

# Paths to the JSON files
products_json_path = os.path.join(os.path.dirname(__file__), '../storage/app/public/modelProducts.json')
users_json_path = os.path.join(os.path.dirname(__file__), '../storage/app/public/modelUsers.json')

# Read JSON files
try:
    with open(products_json_path, 'r', encoding='utf-8') as f:
        products_data = json.load(f)
    with open(users_json_path, 'r', encoding='utf-8') as f:
        user_data = json.load(f)
except Exception as e:
    print(f"Error reading JSON files: {e}")
    sys.exit(1)

print("Data loaded from JSON files")

try:
    df_products = pd.DataFrame(products_data)
    df_users = pd.DataFrame(user_data)
except Exception as e:
    print(f"Error parsing JSON data into DataFrames: {e}")
    sys.exit(1)

print("Data loaded into DataFrames")
# Add order and favorite count
def add_order_favorite_count(user_orders, user_favorites):
    user_order_counts = user_orders.value_counts().reset_index().rename(columns={"index": "product_id", 0: "order_count"})
    user_favorite_counts = user_favorites.value_counts().reset_index().rename(columns={"index": "product_id", 0: "favorite_count"})
    return user_order_counts, user_favorite_counts

try:
    order_counts, favorite_counts = add_order_favorite_count(pd.Series(sum(df_users['past_orders'].dropna(), [])), pd.Series(sum(df_users['favorites'].dropna(), [])))
    print("Order and favorite counts calculated")
except Exception as e:
    print(f"Error calculating order and favorite counts: {e}")
    sys.exit(1)

try:
    df_products = df_products.merge(order_counts, on="product_id", how="left").merge(favorite_counts, on="product_id", how="left")
    df_products = df_products.fillna(0)

    scaler = MinMaxScaler()
    df_products[['order_count', 'favorite_count']] = scaler.fit_transform(df_products[['order_count', 'favorite_count']])

    tfidf_vectorizer = TfidfVectorizer()
    tfidf_matrix = tfidf_vectorizer.fit_transform(df_products['category'])
except Exception as e:
    print(f"Error processing DataFrames: {e}")
    sys.exit(1)

print("DataFrames processed")

try:
    user_profiles = []
    for _, row in df_users.iterrows():
        user_vector = np.zeros(tfidf_matrix.shape[1])
        # Ensure past_orders and favorites are lists, default to empty list if null
        past_orders = row['past_orders'] if row['past_orders'] is not None else []
        favorites = row['favorites'] if row['favorites'] is not None else []
        combined_list = past_orders + favorites
        if combined_list:  # Ensure the combined list is not empty
            for product_id in combined_list:
                product_vector = tfidf_matrix[df_products[df_products['product_id'] == product_id].index[0]].toarray()
                user_vector += product_vector.flatten()
            user_vector /= len(combined_list)  # Only divide if the list is non-empty
        user_profiles.append(user_vector)

    user_profiles = np.vstack(user_profiles)
    product_profiles = tfidf_matrix.toarray()
    similarities = cosine_similarity(user_profiles, product_profiles)

    print("Similarity calculations done")

    def recommend_products_for_all_users(top_n=2):
        recommendations = {}
        for user_index, user_row in df_users.iterrows():
            similarity_scores = similarities[user_index]
            recommended_indices = similarity_scores.argsort()[-top_n:][::-1]
            recommended_products = df_products.iloc[recommended_indices]
            recommendations[user_row['user']] = recommended_products['product_id'].tolist()
        return recommendations

    all_user_recommendations = recommend_products_for_all_users()

    print("Recommendations generated")
    print(json.dumps(all_user_recommendations))
except Exception as e:
    print(f"Error during recommendation generation: {e}")
    sys.exit(1)

try:
    user_profiles = []
    for user, row in df_users.iterrows():
        user_vector = np.zeros(tfidf_matrix.shape[1])
        for product_id in row['past_orders'] + row['favorites']:
            product_vector = tfidf_matrix[df_products[df_products['product_id'] == product_id].index[0]].toarray()
            user_vector += product_vector.flatten()
        user_profiles.append(user_vector / len(row['past_orders'] + row['favorites']))

    user_profiles = np.vstack(user_profiles)
    product_profiles = tfidf_matrix.toarray()
    similarities = cosine_similarity(user_profiles, product_profiles)

    print("Similarity calculations done")

    def recommend_products_for_all_users(top_n=2):
        recommendations = {}
        for user_index, user_row in df_users.iterrows():
            similarity_scores = similarities[user_index]
            recommended_indices = similarity_scores.argsort()[-top_n:][::-1]
            recommended_products = df_products.iloc[recommended_indices]
            recommendations[user_row['user']] = recommended_products['product_id'].tolist()
        return recommendations

    all_user_recommendations = recommend_products_for_all_users()

    print("Recommendations generated")
    print(json.dumps(all_user_recommendations))
except Exception as e:
    print(f"Error during recommendation generation: {e}")
    sys.exit(1)
