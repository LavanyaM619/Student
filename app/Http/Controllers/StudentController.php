<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Http\Requests\Student\{StoreRequest, UpdateRequest};
use App\Models\Student;
use Inertia\Inertia;
use Illuminate\Support\Facades\Storage;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $students = Student::orderBy('created_at', 'desc')          
            ->paginate(10);
        return Inertia::render('Students/Index', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
     
        return Inertia::render('Students/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        
        $request->validate([
            
            'name' => 'required|string|max:255',
      
            'image' => 'required',

            'age' => 'required|integer',
            'status' => 'required|boolean',
        ]);
       
        
        $imageName = time() . '.' . $request->image->getClientOriginalExtension();
    $request->image->move(public_path('images'), $imageName);

       
        Student::create([
            'name' => $request->name,
            'image' => 'images/' . $imageName,
            'age' => $request->age,
            'status' => $request->status,
    ]);
        return redirect()->route('students.index')->with('success', 'Student created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Student $student)
    {
       
        return Inertia::render('Students/Show', compact('student'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Student $student)
    {
       
        return Inertia::render('Students/Edit', compact('student'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Student $student)
{
    // Validate the request data
    //dd($request->all());

    $validatedData = $request->validate([
       'name' => 'sometimes|required|string|max:255', // Allow name to be optional
        'image' => 'required', // Allow image to be optional and only accept image files
        'age' => 'required|integer',
        'status' => 'required|boolean',
    ]);

    // Update student data
  
        $student->name = $validatedData['name'];
   
    $student->age = $validatedData['age'];
    $student->status = $validatedData['status'];

    // Handle image update if provided
    if ($request->hasFile('image')) {
        $image = $request->file('image');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('images'), $imageName);
        $student->image = 'images/' . $imageName;
    }

    $student->save();

    return redirect()->route('students.index')->with('success', 'Student updated successfully.');
}

    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
        $student->delete();
        return redirect()->route('students.index')->with('success', 'Student deleted successfully.');
    }
}
