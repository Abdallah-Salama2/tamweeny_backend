<?php

namespace App\Http\Controllers;

use App\Http\Resources\modelResource;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class PythonController extends Controller
{
    //process alot and mot3eb
//    public function runPythonScript()
//    {
//        $output = null;
//        $retval = null;
//
//        // Set the API endpoint URLs
//        $api1 = 'http://127.0.0.1:8000/api/modelProducts';
//        $api2 = 'http://127.0.0.1:8000/api/modelUsers';
//
//        // Send GET requests to fetch data
//        try {
//            $response1 = Http::get($api1);
//            $response2 = Http::get($api2);
//        } catch (\Exception $e) {
//            return response()->json(['error' => 'Failed to fetch data from API.']);
//        }
//
//        // Check if the responses are successful
//        if (!$response1->successful() || !$response2->successful()) {
//            return response()->json(['error' => 'Failed to fetch data from API.']);
//        }
//
//        // Decode the JSON responses
//        $productsData = $response1->json();
//        $userData = $response2->json();
//
//        // Prepare data to be passed to the Python script
//        $data = [
//            'products' => $productsData,
//            'users' => $userData,
//        ];
//
//        // Convert the data to JSON and save it to a temporary file
//        $tempFilePath = storage_path('app/temp/data.json');
//        Storage::put('temp/data.json', json_encode($data));
//
//        // Path to your Python script
//        $pythonScriptPath = base_path('scripts/example.py');
//
//        // Command to execute the Python script
//        $command = escapeshellcmd("python {$pythonScriptPath} {$tempFilePath}");
//
//        // Execute the command and capture the output
//        try {
//            exec($command, $output, $retval);
//        } catch (\Exception $e) {
//            return response()->json(['error' => 'Failed to run Python script.']);
//        }
//
//        // Return the output and status
//        return response()->json([
//            'output' => $output,
//            'retval' => $retval,
//        ]);
//    }


    public function generateJsonFiles()
    {
        // Fetch the latest data from your models
        $allProducts = Product::with(['productpricing', 'category'])->get();
        $productsArray = [];

        foreach ($allProducts as $product) {
            $productsArray[] = [
                'product_id' => $product->id,
                'description' => $product->description,
                'category' => $product->category->category_name,
                'order_count' => $product->order_count,
                'favorite_count' => $product->favorite_count,
            ];
        }
        $products =$productsArray;// Adjust this to your actual model and data fetching logic
        $allUsers = User::with('card', 'favorite', 'order_made')
            ->where('user_type', 'customer')
            ->get();
        $usersArray=[];
        foreach ($allUsers as $user) {
            $usersArray[] = [
                'user' => $user->name, // Adjust according to your user fields
                'past_orders' => $user->order_made->pluck('product_id'), // Assuming `order_made` relation returns products
                'favorites' => $user->favorite->pluck('product_id'), // Assuming `favorite` relation returns products
            ];
        }
        $users =$usersArray ; // Adjust this to your actual resource class

//        dd($products,$users);
        // Write data to JSON files
        Storage::put('public/modelProducts.json', json_encode($products, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
        Storage::put('public/modelUsers.json', json_encode($users, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));

        return response()->json(['message' => 'JSON files generated successfully']);
    }
    public function runPythonScript()
    {
        $this->generateJsonFiles(); // Ensure the JSON files are up to date

        $output = null;
        $retval = null;

        // Path to your Python script
        $pythonScriptPath = base_path('scripts/recommendations.py');

        // Command to execute the Python script
        $command = escapeshellcmd("python $pythonScriptPath");

        // Execute the command and capture the output
        exec($command, $output, $retval);

        // Return the output and status
        return response()->json([
            'output' => $output,
            'retval' => $retval,
        ]);
    }

//    public function runPythonScript()
//    {
//        $output = null;
//        $retval = null;
//
//        // Path to your Python script
//        $pythonScriptPath = base_path('scripts/recommendations.py');
//
//        // Command to execute the Python script
//        $command = escapeshellcmd("python $pythonScriptPath");
//
//        // Execute the command and capture the output
//        exec($command, $output, $retval);
//
//        // Return the output and status
//        return response()->json([
//            'output' => $output,
//            'retval' => $retval,
//        ]);
//    }
}
