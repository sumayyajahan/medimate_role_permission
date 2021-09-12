<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\FileHelper;
use App\Http\Controllers\Controller;
use App\Models\OtcProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use File;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $products = OtcProduct::latest()->get();
        return view('admin.manage-product', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.add-product');
    }

    public function bulkCreate()
    {
        return view('admin.add-product-bulk');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $imageName = FileHelper::uploadProductImage($request);

        $product = OtcProduct::create(array_merge($request->all(), ['image' => $imageName]));

        return back()->with('success', 'Successfully Created.');
    }
    
    /**
     * bulkStore the product from csv file
     *
     * @param  Request $request
     * @return Response
     */
    public function bulkStore(Request $request)
    {

        if ($request->hasFile('file')) {

            $file = $request->file('file');

            // File Details
            $filename = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            $tempPath = $file->getRealPath();
            $fileSize = $file->getSize();
            $mimeType = $file->getMimeType();

            // Valid File Extensions
            $valid_extension = array("csv");

            // 2MB in Bytes
            $maxFileSize = 24097152;

            // Check file extension
            if (in_array(strtolower($extension), $valid_extension)) {

                // Check file size
                if ($fileSize <= $maxFileSize) {

                    // File upload location
                    $location = 'product/bulk/';

                    // Upload file
                    $file->move($location, $filename);

                    // Import CSV to Database
                    $filepath = public_path($location . "/" . $filename);

                    // Reading file
                    $file = fopen($filepath, "r");

                    $importData_arr = array();
                    $i = 0;

                    while (($filedata = fgetcsv($file, 1000, ",")) !== FALSE) {
                        $num = count($filedata);

                        // Skip first row (Remove below comment if you want to skip the first row)
                        if ($i == 0) {
                            $i++;
                            continue;
                        }
                        for ($c = 0; $c < $num; $c++) {
                            $importData_arr[$i][] = $filedata[$c];
                        }
                        $i++;
                    }
                    fclose($file);

                    // Insert to MySQL database
                    foreach ($importData_arr as $importData) {

                        $insertData = array(
                            "name" => $importData[1],
                            "form" => $importData[2],
                            "generic_name" => $importData[3],
                            "pharmaceutical" => $importData[4],
                            "price" => $importData[5],
                            "category" => $importData[6],
                            "image" => $importData[7]
                        );
                        OtcProduct::create($insertData);
                    }

                    return back()->with('message', 'Import Successful.');
                } else {
                    return back()->with('message', 'File too large. File must be less than 20MB.');
                }
            } else {
                return back()->with('message', 'Invalid File Extension.');
            }
        }
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
        $product = OtcProduct::findOrFail($id);
        return view('admin.edit-product', compact('product'));
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
        $product = OtcProduct::findOrFail($id);

        if ($request->hasFile('image')) {
            $imageName = FileHelper::uploadProductImage($request, $product);
        } else $imageName = $product->image;

        $product->update(array_merge($request->all(), ['image' => $imageName]));

        return back()->with('success', 'Successfully Updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = OtcProduct::findOrFail($id);

        if (File::exists('product/' . $product->image)) {
            File::delete('product/' . $product->image);
        }
        $product->delete();
        return back()->with('success', 'Successfully Deleted.');
    }
}
