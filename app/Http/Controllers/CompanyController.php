<?php

namespace App\Http\Controllers;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Company;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Http\Resources\CompaniesResource;

class CompanyController extends Controller
{

    public function __construct(){
        $this->middleware('auth',['except'=>['index','showCompany','companies', 'company']]);
    }

    public function index(){
        $companies = Company::paginate(4);
        $cat = Category::all();
        //dd($companies);
        return view('pages.home', compact('companies'));
    }

    public function addCompany(){
        return view('pages.add-company');
    }

    public function storeCompany(Request $request){

        $validated = $request->validate([
            'company' => 'required|unique:companies|max:255',
            'code'=>'required',
            'logo' => 'mimes:jpeg,jpg,png,gif'
        ]);

        if(request()->hasFile('logo')){
            $path = $request->file('logo')->store('public/images');
            $fileName = str_replace('public/','',$path);
        }


       Company::create([
           'company'=>request('company'),
           'code'=>request('code'),
           'vat'=>request('vat'),
           'address'=>request('address'),
           'director'=>request('director'),
           'description' => request('description'),
           'logo'=>$fileName,
           'user_id'=>Auth::id()
       ]);

       return redirect('/');
    }

    public function showCompany (Company $company){
    return view('pages.show-company', compact('company'));

    }

    public function deleteCompany(Company $company){
        $company->delete();
        return redirect('/');
    }

    public function updateCompany (Company $company){
        if(Gate::denies('edit-company',$company)){
            dd('Tu neturi teises');
        }
        return view('pages.edit-company', compact('company'));
    }

    public function storeUpdate(Company $company, Request $request){
        if($company->logo){
            File::delete(storage_path('app/public/'.$company->logo));
        }
        if(request()->hasFile('logo')){
            $path = $request->file('logo')->store('public/images');
            $fileName = str_replace('public/','',$path);
            Company::where('id',$company->id)->update(['logo'=>$fileName]);
        }
        Company::where('id', $company->id)->update($request->only(['company', 'code','vat','address', 'director', 'description']));
        return redirect('/company/'.$company->id);
    }

    public function startImport(){
        return view('pages.start-import');
    }

    public function processImport(Request $request){
        $path = $request->file('data')->store('public/data');
        $dataFile = Storage::get($path);
        $dataFile = explode(PHP_EOL,$dataFile);
        return view('pages.start-import', compact('dataFile'));
    }

    public function companies(){
        return  CompaniesResource::collection(Company::paginate());
}

    public function company(Company $company){
        return new CompaniesResource($company);
    }


}
