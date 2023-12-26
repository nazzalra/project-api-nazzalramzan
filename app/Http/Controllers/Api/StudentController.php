<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class StudentController extends Controller
{
    public function search(Request $request)
    {
        $response = Http::get('https://ogienurdiana.com/career/ecc694ce4e7f6e45a5a7912cde9fe131');
        if($response->ok()){
            $results = [];
            $data = explode("\n",$response->json()['DATA']);
            $key = explode("|",$data[0]);
            for($i = 1;$i<count($data);$i++){
                $value = explode("|",$data[$i]);
                if(count($value) === count($key)){
                    $results[] = [
                        $key[0] => $value[0],
                        $key[1] => $value[1],
                        $key[2] => $value[2]
                    ];
                }
            }
            $students = collect($results)
                    ->when($request->nama, function($collection) use ($request){
                        return $collection->where('NAMA', $request->nama);
                    })
                    ->when($request->nim, function($collection) use ($request){
                        return $collection->where('NIM', $request->nim);
                    })
                    ->when($request->ymd, function($collection) use ($request){
                        return $collection->where('YMD', $request->ymd);
                    })
                    ->values();
            return response()->json([
                'status' => 'success',
                'data' => $students
            ]);

        }
    }
}
