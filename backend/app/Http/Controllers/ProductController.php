<?php

namespace App\Http\Controllers;

use App\Models\product;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
      public function create(Request $request){

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'store' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }




        $filename="";
        if($request->hasFile('image')){
            $file=$request->file('image');
            $filename=time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/post', $filename);
        }else{
            $filename=null;
        }

        
        try{
            $image= new product();
            $image->name=$request->name;
            $image->price=$request->price;
            $image->store=$request->store;
            $image->description=$request->description;

            $image->image = $filename;
            $result=$image->save();
            if($result){
                return Response()->json(['success'=>true]);
            }else{
                return Response()->json(['success'=>false]);
            }
        }catch(Exception $e){
            return Response()->json(['error'=>$e]);
        }
        
    }

    public function index(){
        $images = product::all();

        if($images){
            $infoArray = [];
    
            foreach ($images as $image) {
                $imageUrl = asset('storage/post/' . $image->image);
                $infoArray[] = ['image' => $image, 'url' => $imageUrl];
            }
        
            return Response()->json($infoArray);

        }else{
            return Response()->json(['msg'=>'images not found'],404);

        }
      
    }

    public function getInfo($id){
        $images= product::findOrFail($id);
        if($images){
            $imageUrl = asset('storage/post/' . $images->image);
            return Response()->json(['image'=>$images,'url'=>$imageUrl]);
        }else{

            return Response()->json(['msg'=>'image not found'],404);
        }
    
    }



    public function update(Request $request, $id){

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'store' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'image' => 'sometimes|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        //  return response()->json($request->all());
       
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }



        $images= product::findOrFail($id);
        if($request->hasFile('image')){
            File::delete(storage_path('app/public/post/' . $images->image));

            $file=$request->file('image');
            $filename=time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/post', $filename); 
            $images->image = $filename;
        }

        $images->name=$request->name;
        $images->price=$request->price;
        $images->store=$request->store;
        $images->description=$request->description;

        $result= $images->save();

        if($result){
            return Response()->json(['success'=>true]);
        }else{
            return Response()->json(['success'=>false]);
        }
    }

    public function delete($id){
        $image= product::findOrFail($id);
        if($image){
            File::delete(storage_path('app/public/post/' . $image->image)); 
            $result= $image->delete();
            if($result){
                return Response()->json(['success'=>true]);
            }else{
                return Response()->json(['success'=>false]);
            }
        }else{
            return Response()->json(['msg'=>'not found'],404);
        }
      
    }

    public function show($id)
    {
        $image = product::findOrFail($id);

        if ($image) {
            $path = storage_path('app/public/post/' . $image->image);

            // Verificar si la imagen existe en el almacenamiento
            if (File::exists($path)) {
                $file = File::get($path);
                $type = File::mimeType($path);

                // Retornar la vista de la imagen
                return Response::make($file, 200)->header("Content-Type", $type);
            } else {
                return Response()->json(['msg' => 'Imagen no encontrada'], 404);
            }
        } else {
            return Response()->json(['msg' => 'Registro no encontrado'], 404);
        }
    }


}
