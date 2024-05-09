//public function index(Request $request)
//{
//
////        $userId = $request->user()->id;
////        //print("UserID " . $userId . "\n");
////        // Fetch all users with related data
////        $users = User::with('customer', 'customer.card')->get();
////        // Retrieve the user from the collection by ID
////        $user = $users->where("id", $userId)->first();
////        //print($user);
////
////        $customerId = $user->customer->id;
////        //print ("CustomerId " . $customerId . "\n");
//    $customerId = auth()->user()->id;
//
//
//    $customerCart = Cart::where("customer_id", $customerId)->get();
//
//    //$favorites=Favorite::all();
//
//    return response()->json(CartResource::Collection($customerCart));
//}
