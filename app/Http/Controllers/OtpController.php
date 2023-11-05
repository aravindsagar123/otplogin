<?php

namespace App\Http\Controllers;

use App\Models\Register;
use App\Models\Verification;
use Illuminate\Http\Request;
use twilio\Rest\Client;
use Carbon\Carbon;
class OtpController extends Controller
{
    public function index()
    {
        return view("index");
    }
    public function store(Request $request)
{
    try {
        $account_sid = env("TWILIO_SID");
        $account_token = env("TWILIO_AUTH_TOKEN");
        $number = env("TWILIO_PHONE_NUMBER");

        // Generate a 5-digit random number
        $randomNumber = str_pad(mt_rand(0, 99999), 5, '0', STR_PAD_LEFT);

        // Create a new Register model instance and assign attributes
        $cleint = new Register();
        $cleint->name = $request->name;
        $cleint->mobile = $request->mobile;
        $cleint->email = $request->email;
        $cleint->password = bcrypt($request->password);
        $cleint->save(); // Save the model to the database

        // Initialize the Twilio client
        $twilio = new \Twilio\Rest\Client($account_sid, $account_token);

        // Define the recipient's phone number
        $recipientNumber = '+91' . $request->mobile;

        // Send the SMS
        $message = $twilio->messages->create(
            $recipientNumber,
            [
                'from' => $number,
                'body' => 'Your verification code: ' . $randomNumber,
            ]
        );

        if ($message->sid) {
            
            $verification = new Verification();
            $verification->user_id = $cleint->id; 
            $verification->otp = $randomNumber;
            $verification->expire_at = Carbon::now()->addMinutes(5);
            $verification->save();

            return redirect()->route('verify')->with("success", "Form submitted successfully!");
        } else {
            return redirect()->back()->with("error", "Failed to send the SMS.");
        }
    } catch (\Exception $e) {
        return redirect()->back()->with("error", $e->getMessage());
    }
}

}
