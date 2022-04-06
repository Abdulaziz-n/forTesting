<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OrganizationCentre;
use App\Http\Requests\OrganizationCentreRequest;
use Illuminate\Support\Facades\File;

class OrganizationCentreController extends Controller
{
    public function show()
    {
        $organization = OrganizationCentre::all();

        return view('admin.organization.show', compact('organization'));
    }

    public function update($id, OrganizationCentreRequest $request)
    {
        $organization = OrganizationCentre::find($id);

        $organization->title = $request->title;
        $organization->description = $request->description;
        if ($request->hasFile('image')){
            $destination = public_path('images/').$organization->image;
            if(File::exists($destination)){
                File::delete($destination);
            }
            $image = time() . '-'. $request->title . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $image);
            $organization->image = $image;
        }
        $organization->update();

        return redirect()->back()->with('success', 'Успешно обновлен');
    }
}
