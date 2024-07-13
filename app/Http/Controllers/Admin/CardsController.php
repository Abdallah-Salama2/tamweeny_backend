<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Api\AdminCardController;
use App\Http\Controllers\Controller;
use App\Models\AdminCard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class CardsController extends Controller
{
    //

    public function index($flag = null, $str = null)
    {
        $cards = AdminCard::all();
        return Inertia::render('Admin/Notifications/Index', [
            'cards' => $cards,
            'flag' => (int)$flag,
            'message' => $str,
        ]);
    }

    public function update(Request $request)
    {

//        dd($request);
        $card = AdminCard::find($request->cardId);

        if ($request->status == "Decline"):
            $card->card_status_text = "Declined";
            $card->save();
        else:
            if ($card->individuals_number == 1):
                $points = 100;
            elseif ($card->individuals_number == 2):
                $points = 200;
            elseif ($card->individuals_number == 3):
                $points = 300;
            else :
                $points = 400;
            endif;

            $card->update([
                'card_number' => $request->card_number,
                'tamween_points' => $points,
            ]);
            $card->card_status_text = "Accepted";
            $card->save();
        endif;
    }

    public function checkSelfFiles(Request $request)
    {
        // Get the card name from the request
        $cardName = $request->input('cardName');
        $card = AdminCard::where("name", $cardName)->first();
        $national_Id = $card->national_id;
        // Get all directories in the specified path
        $directories = Storage::directories('public/uploads/CardFiles');

        // Find the directory that matches the card name
        $matchingDirectory = null;
        foreach ($directories as $directory) {
            if (basename($directory) === $cardName) {
                $matchingDirectory = $directory;
                break;
            }
        }

        if ($matchingDirectory) {
            // Directory found, check for 'nationalIdCardAndBirthCertificate' folder
            $targetFolder = $matchingDirectory . '/nationalIdCardAndBirthCertificate';

            if (Storage::exists($targetFolder)) {
                // Send the directory path to the Python script
                // dd(realpath($targetFolder));
                $data = $this->runPythonScript(realpath($targetFolder));
                // Extract values from the array
                $name1 = $data[0];
                $name2 = explode(' ', $data[1])[0];
                $combinedName = $name1 . ' ' . $name2;
                $nationalId = $data[2];
                $dateString = $data[3];

                // Extract the date from the date string
                preg_match('/(\d{4}\/\d{1,2}\/\d{1,2})/', $dateString, $matches);
                $expiryDate = $matches[0];

                // Convert extracted date to a DateTime object
                $expiryDate = \DateTime::createFromFormat('Y/m/d', $expiryDate);
                $now = new \DateTime();
                // dd($expiryDate < $now);
                $flag = 0;
                $str = "";
                // dd($nationalId, $date);
                // Check the conditions
                if ($combinedName == $cardName) {
                    if ($nationalId == $national_Id) {
                        if ($expiryDate >= $now) {
                            $flag = 1;
                        } else {
                            $flag = 0;
                            $str = "تاريخ البطاقه منتهي";
                        }
                    } else {
                        $flag = 0;
                        $str = "رقم قومي خطا ";
                    }
                } else {
                    $flag = 0;
                    $str = "عدم تطابق في الاسم";
                }

                // Return back to index notification with the flag as a prop
                return redirect()->route('admin.card.index', ['flag' => $flag, 'str' => $str]);
            } else {
                return Inertia::render('Admin/Notifications/Index', [
                    'cards' => AdminCard::all(),
                    'flag' => 0,
                    'message' => 'Target folder not found'
                ]);
            }
        } else {
            // Directory not found
            return Inertia::render('Admin/Notifications/Index', [
                'cards' => AdminCard::all(),
                'flag' => 0,
                'message' => 'Directory not found'
            ]);
        }
    }

    public function checkFollowersFiles(Request $request)
    {
        // Get the card name from the request
        $cardName = $request->input('cardName');
        // Get all directories in the specified path
        $directories = Storage::directories('public/uploads/CardFiles');

        // Find the directory that matches the card name
        $matchingDirectory = null;
        foreach ($directories as $directory) {
            if (basename($directory) === $cardName) {
                $matchingDirectory = $directory;
                break;
            }
        }

        if ($matchingDirectory) {
            // Directory found, check for 'nationalIdCardAndBirthCertificate' folder
            $targetFolder = $matchingDirectory . '/followersNationalIdCardsAndBirthCertificates';

            if (Storage::exists($targetFolder)) {
                // Get all files in the 'nationalIdCardAndBirthCertificate' folder
                $files = Storage::files($targetFolder);

                // Read file contents (assuming you need to read and return them)
                $fileContents = [];
                foreach ($files as $file) {
                    $fileContents[] = [
                        'path' => $file,
                    ];
                }
                return response()->json([
                    'message' => 'Folder and files found',
                    'files' => $fileContents
                ]);
            } else {
                return response()->json(['message' => 'Target folder not found'], 404);
            }
        } else {
            // Directory not found
            return response()->json(['message' => 'Directory not found'], 404);
        }
    }

    public function runPythonScript($directoryPath)
    {
        // Path to your Python script
        $pythonScriptPath = base_path('scripts/Ocr.py');

        // Command to execute the Python script with the directory path as an argument
        $command = escapeshellcmd("python " . escapeshellarg($pythonScriptPath) . " " . escapeshellarg($directoryPath));
//        $command = escapeshellcmd("python $pythonScriptPath" ." " .$directoryPath);
//        dd($command);
        // Execute the command and capture the output
        $output = [];
        $retval = null;
        exec($command, $output, $retval);
//        dd($output);

        // Join the output lines into a single JSON string
        $json_output = implode("\n", $output);
//        dd($json_output);

        // Decode the JSON output
        $decoded_array = json_decode($json_output, true);
//        dd($decoded_array);

        // Return the output and status
        return $decoded_array;
    }

//    public function runPythonScript()
//    {
//        // Path to your Python script
//        $pythonScriptPath = base_path('scripts/Ocr.py');
//
//        // Command to execute the Python script with the directory path as an argument
//        $command = "python \"$pythonScriptPath\"";
////        dd($command);
////        dd(escapeshellarg($directoryPath));
//        // Execute the command and capture the output
//        $output = [];
//        $retval = null;
//        exec($command, $output, $retval);
////        dd($output);
//
//        // Join the output lines into a single JSON string
//        $json_output = implode("\n", $output);
//
//        // Decode the JSON output
//        $decoded_array = json_decode($json_output, true);
////        dd($decoded_array);
//        // Return the output and status
//        return response()->json([
//            'decoded_output' => $decoded_array,
//            'retval' => $retval,
//        ]);
//    }


}
