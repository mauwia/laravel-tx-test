<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session as FacadesSession;

class transactionController extends Controller
{

    public function search_entry(Request $request)
    {
        // dd($request->input('search'));
        if ($request->has('search')) {
            $address = $request->input('search');
            $entries = Transaction::where('address', $address)->get();
            $total = Transaction::where('address', $address)->sum("amount");

        } else {
            $entries = Transaction::all();
            $total = Transaction::sum("amount");

        }
        return view('index', ['entries' => $entries, 'total' => $total]);

        // return Transaction::where('address',$address)->get();
    }
    public function get_entries()
    {
        return Transaction::all();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $entries = Transaction::all();
        $total = Transaction::sum("amount");
        return view('index', ['entries' => $entries, "total" => $total]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
        // dd($request->file('file'));
        $file = $request->file('file');
        $file->move(storage_path(), $file->getClientOriginalName());
        $filename = $file->getClientOriginalName();

        $entries = collect([]);
        if (($open = fopen(storage_path() . '/' . $filename, "r")) !== FALSE) {

            while (($data = fgetcsv($open, 1000, ",")) !== FALSE) {
                // dd(gettype($data));
                if (!in_array('Txhash', $data)) {
                    $users[] = $data;
                    $entries->push([
                        "txhash" => $data[0],
                        "datetime" => $data[1],
                        "address" => $data[2],
                        "amount" => floatval(str_replace(',', '', $data[3]))
                    ]);
                }
            }

            fclose($open);
        }
        Transaction::insert($entries->toArray());
        $entries = Transaction::all();
        $total = Transaction::sum("amount");

        return view('index', ['message' => 'Data imported successfully!', 'entries' => $entries, 'total' => $total]);
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $users = [];
        $entries = collect([]);
        if (($open = fopen(storage_path() . "/test.csv", "r")) !== FALSE) {

            while (($data = fgetcsv($open, 1000, ",")) !== FALSE) {
                // dd(gettype($data));
                if (!in_array('Txhash', $data)) {
                    $users[] = $data;
                    $entries->push([
                        "txhash" => $data[0],
                        "datetime" => $data[1],
                        "address" => $data[2],
                        "amount" => $data[3]
                    ]);
                }
            }

            fclose($open);
        }
        Transaction::insert($entries->toArray());
        return $entries;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}