import pandas as pd
import numpy as np
from sklearn.feature_extraction.text import TfidfVectorizer
from sklearn.metrics.pairwise import cosine_similarity
from sklearn.preprocessing import MinMaxScaler
import requests
import json
import sys

# Set the API endpoint URL
api1 = 'http://127.0.0.1:8000/api/modelProducts'
api2 = 'http://127.0.0.1:8000/api/modelUsers'

# Send a GET request (adjust if your API requires a different method)
response1 = requests.get(api1)
response2 = requests.get(api2)
response1.encoding = 'utf-8'
response2.encoding = 'utf-8'

# Check for successful response
if response1.status_code == 200:
    products_data = response1.json()  # Assuming JSON response format
    df_products = pd.DataFrame(products_data)
else:
    print(f"API request failed with status code: {response1.status_code}")
    sys.exit(1)

if response2.status_code == 200:
    user_data = response2.json()  # Assuming JSON response format
    df_users = pd.DataFrame(user_data)
else:
    print(f"API request failed with status code: {response2.status_code}")
    sys.exit(1)

# Add order and favorite count
def add_order_favorite_count(user_orders, user_favorites):
    user_order_counts = user_orders.value_counts().reset_index().rename(columns={"index": "product_id", 0: "order_count"})
    user_favorite_counts = user_favorites.value_counts().reset_index().rename(columns={"index": "product_id", 0: "favorite_count"})
    return user_order_counts, user_favorite_counts

order_counts, favorite_counts = add_order_favorite_count(pd.Series(sum(df_users['past_orders'], [])), pd.Series(sum(df_users['favorites'], [])))

# Merge with product data
df_products = df_products.merge(order_counts, on="product_id", how="left").merge(favorite_counts, on="product_id", how="left")
df_products = df_products.fillna(0)  # Fill NaN values with 0

# Normalize the order and favorite counts
scaler = MinMaxScaler()
df_products[['order_count', 'favorite_count']] = scaler.fit_transform(df_products[['order_count', 'favorite_count']])

# Apply TF-IDF vectorizer to product categories
tfidf_vectorizer = TfidfVectorizer()
tfidf_matrix = tfidf_vectorizer.fit_transform(df_products['category'])

# Generate user profiles
user_profiles = []
for user, row in df_users.iterrows():
    user_vector = np.zeros(tfidf_matrix.shape[1])
    for product_id in row['past_orders'] + row['favorites']:
        product_vector = tfidf_matrix[df_products[df_products['product_id'] == product_id].index[0]].toarray()
        user_vector += product_vector.flatten()
    user_profiles.append(user_vector / len(row['past_orders'] + row['favorites']))

user_profiles = np.vstack(user_profiles)

# Calculate similarities between user profiles and products
product_profiles = tfidf_matrix.toarray()
similarities = cosine_similarity(user_profiles, product_profiles)

# Generate recommendations for all users
def recommend_products_for_all_users(top_n=2):
    recommendations = {}
    for user_index, user_row in df_users.iterrows():
        similarity_scores = similarities[user_index]
        recommended_indices = similarity_scores.argsort()[-top_n:][::-1]
        recommended_products = df_products.iloc[recommended_indices]
        recommendations[user_row['user']] = recommended_products['product_id'].tolist()
    return recommendations

# Generate recommendations for all users
all_user_recommendations = recommend_products_for_all_users()

# Print recommendations as JSON
print(json.dumps(all_user_recommendations))
