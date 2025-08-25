<?php

namespace App\Http\Controllers\Auth\Talent;

use Exception;
use Illuminate\Http\Request;
use App\Helpers\ImageHelpers;
use App\Models\MasterData\Talent;
use App\Http\Controllers\Controller;
use App\Models\MasterData\ArtCategory;
use App\Models\MasterData\ProfessionalCategory;

class RegisterController extends Controller
{
    protected $fileHelper;
    public function __construct() {
        $this->fileHelper = new ImageHelpers('back_assets/file/talent/cv/');
    }
    public function index()
    {
        $professionalCategories = ProfessionalCategory::get(['id', 'name']);
        $artCategories = ArtCategory::get(['id', 'name']);

        return view('auth.talent.register', compact('professionalCategories', 'artCategories'));
    }

    public function store(Request $request)
    {
        $talent = $this->storeTalent($request);

        $this->storeTalentArt($request, $talent);
        $this->storeTalentContent($request, $talent);
        $this->storeTalentProfessional($request, $talent);
        $this->storeTalentEducation($request, $talent);
        $this->storeTalentWorkExperience($request, $talent);
        $this->storeTalentPhoto($request, $talent);
        $this->storeTalentExperience($request, $talent);
        $this->storeTalentPortofolio($request, $talent);
        $this->storeTalentRate($request, $talent);

        return redirect()->route('front.home')->with('success', 'Berhasil mendaftar menjadi talent, Mohon tunggu pihak kami memberi kabar kepada anda');
    }

    public function storeTalent(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required',
                'birth_date' => 'required|date',
                'birth_place' => 'required',
                'gender' => 'required',
                'appereance' => 'required',
                'address' => 'required',
                'email' => 'required',
                'phone' => 'required',
                'instagram' => 'nullable',
                'cv' => 'nullable | file',
                'tiktok' => 'nullable',
                'facebook' => 'nullable',
                'marriage_status' => 'nullable',
                'introduction_link' => 'required',
                'description' => 'nullable'
            ]);

            $validated['password'] = 'talentbinco123!';

            if($request->hasFile('cv')) {
                $cvPath = $this->fileHelper->uploadImage($request, 'cv');
                $validated['cv'] = $cvPath;
            }

            if($request->has('status')) {
                $validated['status'] = $request->status;
            }

            if($request->has('description')) {
                $validated['description'] = $request->description;
            } else {
                $validated['description'] = '-';
            }

            $talent = Talent::create($validated);

            return $talent;
        } catch (\Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function storeTalentArt(Request $request, Talent $talent)
    {
        $validate = $request->validate([
            'talent_art' => 'required | array'
        ]);

        foreach($validate['talent_art'] as $item) {
            $artCategory = ArtCategory::updateOrCreate(['name' => $item]);

            $talent->talentArts()->attach([$artCategory->id]);
        }
    }

    public function storeTalentContent(Request $request, Talent $talent)
    {
        $validate = $request->validate([
            'talent_content' => 'required | array'
        ]);

        foreach($validate['talent_content'] as $item) {
            $talent->talentContents()->create([
                'name' => $item
            ]);
        }
    }

    public function storeTalentProfessional(Request $request, Talent $talent)
    {
        $validate = $request->validate([
            'talent_professional' => 'required | array'
        ]);

        foreach ($validate['talent_professional'] as $item) {
            $professionalCategory = ProfessionalCategory::updateOrCreate(['name' => $item]);

            $talent->talentProfessionals()->attach([$professionalCategory->id]);
        }
    }

    public function storeTalentEducation(Request $request, Talent $talent)
    {
        $validate = $request->validate([
            'education_level' => 'required',
            'education_institution' => 'required',
            'education_major' => 'required',
            'education_year' => 'required'
        ]);

        $talent->talentEducation()->create([
            'education_level' => $validate['education_level'],
            'institution_name' => $validate['education_institution'],
            'major' => $validate['education_major'],
            'graduation_year' => $validate['education_year']
        ]);
    }

    public function storeTalentWorkExperience(Request $request, Talent $talent)
    {
        $validate = $request->validate([
            'work_company' => 'nullable | array',
            'work_position' => 'nullable | array',
            'work_period' => 'nullable | array',
            'work_description' => 'nullable | array',
            'work_quit' => 'nullable | array',
        ]);

        $arrayWorks = $validate['work_company'] ?? false;

        if($arrayWorks) {
            $countingArray = count($validate['work_company']);

            for ($i=0; $i < $countingArray; $i++) {
                $talent->talentWorkExperiences()->create([
                    'company' => $validate['work_company'][$i],
                    'position' => $validate['work_position'][$i],
                    'employment_period' => $validate['work_period'][$i],
                    'description' => $validate['work_description'][$i],
                    'quit_reason' => $validate['work_quit'][$i],
                ]);
            }
        }
    }

    public function storeTalentPhoto(Request $request, Talent $talent)
    {
        $validate = $request->validate([
            'talent_photo' => 'required | array'
        ]);

        foreach($validate['talent_photo'] as $item) {
            $talent->talentPhotos()->create([
                'image' => $this->uploadImage( $item)
            ]);
        }
    }

    public function uploadImage($file)
    {
        if (is_file($file)) {
            $fileNameWithExt = $file->getClientOriginalName();
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            $fileExtension = $file->getClientOriginalExtension();
            $fileNameToStore = preg_replace('/\s+/', '-', $fileName) . '-' . time() . '.' . $fileExtension;
            $path = $file->move('back_assets/img/master-data/talent/photos/', $fileNameToStore);

            if ($fileNameToStore != null) {
                return $path;
            } else {
                return "noimage.png";
            }
        } else {
            return "noimage.png";
        }
    }

    public function storeTalentExperience(Request $request, Talent $talent)
    {
        $validate = $request->validate([
            'experience_skill' => 'nullable | array',
            'experience_period' => 'nullable | array',
            'experience_link' => 'nullable | array',
        ]);

        $arrayExperiences = $validate['experience_skill'] ?? false;

        if($arrayExperiences) {
            $countingArray = count($validate['experience_skill']);

            for ($i=0; $i < $countingArray; $i++) {
                $talent->talentExperiences()->create([
                    'skill' => $validate['experience_skill'][$i],
                    'period' => $validate['experience_period'][$i],
                    'link' => $validate['experience_link'][$i],
                ]);
            }
        }
    }

    public function storeTalentPortofolio(Request $request, Talent $talent)
    {
        $validate = $request->validate([
            'portofolio_skill' => 'nullable | array',
            'portofolio_link' => 'nullable | array'
        ]);

        $arrayPortofolios = $validate['portofolio_skill'] ?? false;

        if($arrayPortofolios) {
            $countingArray = count($validate['portofolio_skill']);

            for ($i=0; $i < $countingArray; $i++) {
                $talent->talentPortfolios()->create([
                    'skill' => $validate['portofolio_skill'][$i],
                    'link' => $validate['portofolio_link'][$i],
                ]);
            }
        }
    }

    public function storeTalentRate(Request $request, Talent $talent)
    {
        $validate = $request->validate([
            'rate_period' => 'nullable',
            'rate_rate' => 'nullable',
            'rate_call_day' => 'required',
            'rate_call_time' => 'required',
        ]);

        $talent->talentRate()->create([
            'period' => $validate['rate_period'],
            'rate' => $validate['rate_rate'],
            'call_day' => $validate['rate_call_day'],
            'call_time' => $validate['rate_call_time'],
        ]);
    }
}
