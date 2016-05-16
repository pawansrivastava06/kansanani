<?php

namespace SundaySim\Http\Controllers\Backend;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use SundaySim\Http\Requests;
use SundaySim\Http\Controllers\Controller;
use SundaySim\Models\Categories;
use SundaySim\Models\Opinion;
use SundaySim\Models\Tag;
use Auth;
use Carbon;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {        
        $this->categories=new Categories();
        $categories=$this->categories->getAllcategories();    
        return view('backend.categories.view',compact('categories')); 
    }
    
    public function form()
    {        
       return view('backend.categories.form');        
    }
    
    public function addCategories(){
        $inputs = Input::all();
        $validator = $this->validator($inputs);
        if ($validator->fails()) {
            return redirect('/backend/categories/form')->withErrors($validator)->withInput();
        } else {
            if ($inputs['id']) {
                $message = 'Categories updated Successfully!!';
                $this->create($inputs);
                return redirect('/backend/categories/index')->with('message', $message);
            } else {
                $message = 'Categories Created Successfully!!';
                $project = $this->create($inputs);                                               
                return redirect('/backend/categories/index')->with('message', $message);
            }
        }
    }
    
    public function editCategories($id) {        
        $categories = new Categories();
        $categoriesData = $categories::where('id', $id)->get()->toArray();        
        return view('backend.categories.form')->with('categories', $categoriesData[0]);
    }
    
    public function deleteCategories() {
        $categoryId = Input::get('id');       
        $categories = new Categories();        
        $categories->destroy($categoryId);
    }
    
     protected function create(array $data) {     
        if ($data['id']) {
          $categories = new Categories();
            $categories::where('id', $data['id'])->update([
                'name' => $data['name'],
                'status' => $data['status'],
                'updated_by' => Auth::user()->id, 
                'updated_at' => Carbon\Carbon::now()->toDateTimeString(),                
            ]);
        } else {
            return Categories::create([
                'name' => $data['name'],
                'status' => $data['status'],
                'created_by' => Auth::user()->id, 
                'created_at' => Carbon\Carbon::now()->toDateTimeString(),
            ]);
        }
    }

       
    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data) {
        return Validator::make($data, [
                    'name'=>'required',
                    'status' => 'required'                    
        ]);
    }
    
    
    public function allCategories(){
        $categories = new Categories();
        $allCategories=$categories::all()->toArray();
        echo json_encode($allCategories);exit;
    }
    
    public function saveOpinion(){
      $input=Input::all();     
       
      $tagExist=$this->checkTagExist($input['tags_id']);      
      return Opinion::create([
                'opinion_quote' => $input['opinion_quote'],
                'opinion_description' => $input['opinion_description'],
                'opinion_category_id' => $input['category_id'],
                'tag_id' => $input['tags_id'],
                'created_by' => Auth::user()->id, 
                'updated_by' => Auth::user()->id, 
                'created_at' => Carbon\Carbon::now()->toDateTimeString(),
        ]);
    }
    
    public function checkTagExist($tag){       
       return Tag::where('id','=',$tag)->get()->toArray();
    }
}
