<?php

namespace App\Http\Controllers;

use App\Todo;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $jsonurl = env("API_URL")."/todos";
        $json = file_get_contents($jsonurl);
        $datas = json_decode($json);
        return view('home', compact('datas'));
    }

    public function create()
    {
        return view('create');
    }

    public function store(Request $request)
    {
        $todo = new Todo();
        $todo->title = $request->title;
        $todo->description = $request->description;
        $todo->targetDate = $request->target_date;
        
        $data_json = json_encode($todo);

        // API URL to update data
        $url = env("API_URL")."todos/";
        
        // curl initiate
        $ch = curl_init();
        
        curl_setopt($ch, CURLOPT_URL, $url);
        
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json','Content-Length: ' . strlen($data_json)));
        
        // SET Method as a PUT
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        
        // Pass data in POST command
        curl_setopt($ch, CURLOPT_POSTFIELDS,$data_json);
        
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        
        // Execute curl and assign returned data
        $response  = curl_exec($ch);
        
        // Close curl
        curl_close($ch);

        return redirect('home');
    }

    public function edit($id)
    {
        $jsonurl = env("API_URL")."todos/" . $id;
        $json = file_get_contents($jsonurl);
        $data = json_decode($json);
        return view('edit', compact('data'));
    }   

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title'   => 'required',
            'description'  => 'required',
            'target_date' => 'required',
        ]);

        $jsonurl = env("API_URL")."todos/" . $id;
        $json = file_get_contents($jsonurl);
        $data = json_decode($json);

        $data->title = $request->title;
        $data->description = $request->description;
        $data->targetDate = $request->target_date;
        $data_json = json_encode($data);

        // API URL to update data
        $url = env("API_URL")."todos/";
        
        // curl initiate
        $ch = curl_init();
        
        curl_setopt($ch, CURLOPT_URL, $url);
        
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json','Content-Length: ' . strlen($data_json)));
        
        // SET Method as a PUT
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
        
        // Pass data in POST command
        curl_setopt($ch, CURLOPT_POSTFIELDS,$data_json);
        
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        
        // Execute curl and assign returned data
        $response  = curl_exec($ch);
        
        // Close curl
        curl_close($ch);
        
        return redirect('home');
    }

    public function destroy($id)
    {
        $jsonurl = env("API_URL")."todos/" . $id;
        $data_json = file_get_contents($jsonurl);

        // API URL to update data
        $url = env("API_URL")."todos/".$id;
        
        // curl initiate
        $ch = curl_init();
        
        curl_setopt($ch, CURLOPT_URL, $url);
        
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json','Content-Length: ' . strlen($data_json)));
        
        // SET Method as a PUT
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
        
        // Pass data in POST command
        curl_setopt($ch, CURLOPT_POSTFIELDS,$data_json);
        
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        
        // Execute curl and assign returned data
        $response  = curl_exec($ch);
        
        // Close curl
        curl_close($ch);
        
        return redirect('home');
    }
}
