<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;

class AddressLabelController extends Controller
{
    public function index()
    {
        $addresslabel = DB::table('address_labels')->get();

        $data = [
            'addresslabel' => $addresslabel,
            'script'   => 'components.scripts.addresslabel'
        ];

        return view('pages.addresslabel', $data);
    }

    public function show($id) {
        if(is_numeric($id)) {
            $data = DB::table('address_labels')->where('id', $id)->first();

            //$data->status = number_format($data->status);

            return Response::json($data);
        }

        $data = DB::table('address_labels')

            ->select([
                'address_labels.*'
            ])
            ->orderBy('address_labels.id', 'desc');

        return DataTables::of($data)



            ->addColumn(
                'action',
                function($row) {
                    $data = [
                        'id' => $row->id,

                    ];

                    return view('components.buttons.addresslabel', $data);
                }
            )
            ->addIndexColumn()
            ->make(true);
    }

    public function store(Request $request)
    {



        if($request->name == NULL) {
            $json = [
                'msg'       => 'Mohon masukan nama service category',
                'status'    => false
            ];

        } else {


            try{
                DB::transaction(function() use($request) {
                    DB::table('address_labels')->insert([
                        'created_at' => date('Y-m-d H:i:s'),
                        'name' => $request->name,


                    ]);
                });

                $json = [
                    'msg' => 'AddressLabel Berita berhasil ditambahkan',
                    'status' => true
                ];
            } catch(Exception $e) {
                $json = [
                    'msg'       => 'error',
                    'status'    => false,
                    'e'         => $e
                ];
            }
        }

        return Response::json($json);
    }

    public function edit(Request $request, $id)
    {




        if($request->name == NULL) {
            $json = [
                'msg'       => 'Mohon masukan nama addresslabel',
                'status'    => false
            ];
        }  else {
            try{
              DB::transaction(function() use($request, $id) {
                  DB::table('address_labels')->where('id', $id)->update([
                      'updated_at' => date('Y-m-d H:i:s'),
                      'name' => $request->name,
                   

                  ]);
              });

                $json = [
                    'msg' => 'Service Category berhasil dirubah',
                    'status' => true
                ];
            } catch(Exception $e) {
                $json = [
                    'msg'       => 'error',
                    'status'    => false,
                    'e'         => $e
                ];
            }
        }

        return Response::json($json);
    }

    public function destroy($id)
    {

            try{

              DB::transaction(function() use($id) {
                  DB::table('address_labels')->where('id', $id)->delete();
              });

                $json = [
                    'msg' => 'Service Category Berita berhasil dihapus',
                    'status' => true
                ];
            } catch(Exception $e) {
                $json = [
                    'msg'       => 'error',
                    'status'    => false,
                    'e'         => $e
                ];
            }


        return Response::json($json);
    }
}
