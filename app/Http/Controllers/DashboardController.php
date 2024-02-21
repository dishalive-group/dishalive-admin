<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Campaigns;
use App\Models\Reports;
use App\Models\Credits;
use App\Models\User;
use Auth;
use File;

class DashboardController extends Controller
{
    public function index(){
        return view('dashboard.index');
    }
    
    public function scheduleCampaign(){
        return view('dashboard.schedule-campaign');
    }

    public function scheduleCampaignNow(Request $request){
        $request->validate([
            "title"=> "required",
            'contactList' => 'required',
            'audioFile' => 'required',
        ]);
        
        $db = new Campaigns;        
        $user = Auth::user();
        if($user->credits <= 0){
            return back()->with('error', 'You have not sufficent credits in your account.');
        }
        $ran = rand(111111, 999999);
        $db->user_id = $user->id;
        $db->title = $request->title;
        $db->scheduleDateTime = $request->scheduleDateTime;

        if(!is_null($request['contactList'])){
            $imageName = date("d-m-Y").'-'. $ran . '-' .$request->contactList->getClientOriginalName();
            $request->contactList->move(public_path('uploads/contact-lists/'. $user->id .'/'), $imageName);
            $db->contactList = $imageName;
        }

        if(!is_null($request['audioFile'])){
            $imageName = date("d-m-Y"). '-' . $ran .'-'.$request->audioFile->getClientOriginalName();
            $request->audioFile->move(public_path('uploads/audio-files/'. $user->id .'/'), $imageName);
            $db->audioFile = $imageName;
        }

        $db->save();
        return back()->with("message", "Campaign scheduled successfully!");
    }
    
    public function userCampaigns(){
        $user_id = Auth::user()->id;
        $reports = Campaigns::with('reports')->where('user_id', $user_id)->orderBy('id', 'desc')->get();
        $data = compact('user_id', 'reports');
        return view('dashboard.user-campaigns')->with($data);
    }
    
    public function reports(){
        $user_id = Auth::user()->id;
        $reports = Reports::where('user_id', $user_id)->orderBy('id', 'desc')->get();
        $data = compact('user_id', 'reports');
        return view('dashboard.reports')->with($data);
    }
    
    public function transactions(){
        $user_id = Auth::user()->id;
        $transactions = Credits::where('user_id', $user_id)->orderBy('id', 'desc')->get();
        $data = compact('user_id', 'transactions');
        return view('dashboard.transactions')->with($data);
    }

    public function UnderProcessCampaigns(){
        $title = "Under Process Campaigns";
        $campaigns = Campaigns::with('reports')->where('status', 'Under Process')->orWhere('status', 'On the way')->orderBy('scheduleDateTime', 'asc')->get();
        $data = compact('campaigns', 'title');
        return view('dashboard.campaigns')->with($data);
    }

    public function scheduledCampaigns(){
        $title = "Scheduled Campaigns";
        $campaigns = Campaigns::with('reports')->where('status', 'scheduled')->orderBy('scheduleDateTime', 'asc')->get();
        $data = compact('campaigns', 'title');
        return view('dashboard.campaigns')->with($data);
    }

    public function updateCampaign(Request $request, $id){
        $db = Campaigns::find($id);
        $db->status = $request->status;
        $db->cost = $request->cost;
        $db->totalContacts = $request->totalContacts;
        $db->scheduleDateTime = $request->scheduleDateTime;
        $db->remarks = $request->remarks;

        if($db->save()){
            if($request->status == "Scheduled"){
                $db = new Credits;
                $db->user_id = $request->user_id;
                $db->credits = -$request->totalContacts;
                $db->rate = $request->rate;
                $db->amount = $request->cost * -1;
                $db->paymentMode = "Wallet";
                $db->paymentStatus = "Paid";
                $db->remarks = "Charges for campaign ID: ".  $id;
                if($db->save()){
                    $db = User::find($request->user_id);
                    $oldCredits = $db->credits;
                    $db->credits = $oldCredits - $request->totalContacts;
                    $db->save();
                }
            }
        }

        if(!is_null($request->report)){
            $ran = rand(111111, 99999);
            $user_id = $request->user_id;
            foreach($request->report as $report){
                $db = new Reports;
                $db->campaign_id = $id;
                $db->user_id = $user_id;
                if(!is_null($report)){
                    $imageName = date("d-m-Y").'-'. $ran . '-' . $report->getClientOriginalName();
                    $report->move(public_path('uploads/reports/'. $user_id .'/'), $imageName);
                    $db->file = $imageName;
                }
                $db->save();
            }
        }

        return back()->with('message', 'Campaign updated successfully!');

    }

    public function allCampaigns(){
        $title = "All Campaigns";
        $campaigns = Campaigns::with('reports')->orderBy('scheduleDateTime', 'asc')->get();
        $data = compact('campaigns', 'title');
        return view('dashboard.campaigns')->with($data);
    }

    public function deleteCampaignReport($id){
        $db = Reports::find($id);
        $file = $db->file;
        $user_id = $db->user_id;

        if($db->delete()){
            File::delete('uploads/reports/'. $user_id . '/' . $file);
            return back()->with("message", "Deleted successfully!");
        }else{
            return back()->with("message", "Oops! Somting went wrong.");
        }
    }

    public function addCredits(Request $request){
        $db = new Credits;
        $db->user_id = $request->user_id;
        $db->credits = $request->credits;
        $db->rate = $request->rate;
        $db->amount = $request->amount;
        $db->paymentMode = $request->paymentMode;
        $db->paymentStatus = $request->paymentStatus;
        $db->remarks = $request->remarks;
        if($db->save()){
            $db = User::find($request->user_id);
            $oldCredits = $db->credits;
            $db->credits = $oldCredits + $request->credits;
            $db->save();
            return back()->with('message', 'Credit added successfully!');
        }else{
            return back()->with('error', 'Oops! Something went wrong.');
        }
        
    }
    
    public function allReports(){
        $user_id = Auth::user()->id;
        $reports = Reports::orderBy('id', 'desc')->get();
        $data = compact('user_id', 'reports');
        return view('dashboard.reports')->with($data);
    }
    
    public function allTransactions(){
        $user_id = Auth::user()->id;
        $transactions = Credits::orderBy('id', 'desc')->get();
        $data = compact('user_id', 'transactions');
        return view('dashboard.transactions')->with($data);
    }

    public function updateMyCredits(){
        return back()->with('message', 'You are not authorised to perform the action.');
    }
}
