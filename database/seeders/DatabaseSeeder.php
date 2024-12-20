<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Enums\RoleEnum;
use App\Models\AdverbType;
use App\Models\DestinationType;
use App\Models\Contact;
use App\Models\Country;
use App\Models\Destination;
use App\Models\District;
use App\Models\DocumentType;
use App\Models\Email;
use App\Models\Language;
use App\Models\ModelJob;
use App\Models\Permission;
use App\Models\Province;
use App\Models\RequestType;
use App\Models\Role;
use App\Models\RolePermission;
use App\Models\ScanType;
use App\Models\Setting;
use App\Models\SettingTimeUnit;
use App\Models\Source;
use App\Models\Status;
use App\Models\TimeUnit;
use App\Models\Translate;
use App\Models\Urgency;
use App\Models\User;
use App\Models\UserPermission;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        $this->languages();
        $this->statuses();
        $this->urgencies();
        $this->documentTypes();
        $this->sources();
        $this->scanTypes();
        $this->settings();
        $this->requestTypes();
        $this->adverbs();
        $superEmail =  Email::factory()->create([
            "value" => "super@admin.com"
        ]);
        $debuggerEmail =  Email::factory()->create([
            "value" => "debugger@admin.com"
        ]);
        Role::factory()->create([
            "id" => RoleEnum::super,
            "name" => "super"
        ]);
        Role::factory()->create([
            "id" => RoleEnum::admin,
            "name" => "admin"
        ]);
        Role::factory()->create([
            "id" => RoleEnum::user,
            "name" => "user"
        ]);
        Role::factory()->create([
            "id" => RoleEnum::debugger,
            "name" => "debugger"
        ]);
        $muqam =  DestinationType::factory()->create([
            "name" => "Muqam",
        ]);
        $directorate =  DestinationType::factory()->create([
            "name" => "Directorate",
        ]);
        $this->Translate("مقام", "fa", $muqam->id, DestinationType::class);
        $this->Translate("مقام", "ps", $muqam->id, DestinationType::class);
        $this->Translate("ریاست ", "fa", $directorate->id, DestinationType::class);
        $this->Translate("ریاست ", "ps", $directorate->id, DestinationType::class);
        $jobAdmin =  ModelJob::factory()->create([
            "name" => "Administrator",
        ]);
        $this->Translate("مدیر", "fa", $jobAdmin->id, ModelJob::class);
        $this->Translate("مدیر", "ps", $jobAdmin->id, ModelJob::class);
        $jobDebugger =  ModelJob::factory()->create([
            "name" => "Debugger",
        ]);
        $this->Translate("دیبگر", "fa", $jobDebugger->id, ModelJob::class);
        $this->Translate("دیبگر", "ps", $jobDebugger->id, ModelJob::class);

        $this->offic($muqam);
        $this->destinations($directorate);
        User::factory()->create([
            'full_name' => 'Dean',
            'username' => 'Administrator',
            'email_id' =>  $superEmail->id,
            'password' =>  Hash::make("123123123"),
            'status' =>  true,
            'grant_permission' =>  true,
            'role_id' =>  RoleEnum::super,
            'contact_id' =>  null,
            'job_id' =>  $jobAdmin->id,
            'destination_id' =>  1,
        ]);
        User::factory()->create([
            'full_name' => 'Sayed Naweed Sayedy',
            'username' => 'Debugger',
            'email_id' =>  $debuggerEmail->id,
            'password' =>  Hash::make("123123123"),
            'status' =>  true,
            'grant_permission' =>  true,
            'role_id' =>  RoleEnum::debugger,
            'contact_id' =>  null,
            'job_id' =>  $jobDebugger->id,
            'destination_id' =>  1,
        ]);
        // Icons
        $dashboard = 'public/icons/home.svg';
        $users = 'public/icons/users-group.svg';
        $chart = 'public/icons/chart.svg';
        $settings = 'public/icons/settings.svg';
        $logs = 'public/icons/logs.svg';
        $audit = 'public/icons/audits.svg';
        $documents = 'public/icons/documents.svg';
        Permission::factory()->create([
            "name" => "dashboard",
            "icon" => $dashboard,
            "priority" => 1
        ]);
        Permission::factory()->create([
            "name" => "users",
            "icon" => $users,
            "priority" => 3
        ]);
        Permission::factory()->create([
            "name" => "settings",
            "icon" => $settings,
            "priority" => 4
        ]);
        Permission::factory()->create([
            "name" => "reports",
            "icon" => $chart,
            "priority" => 5
        ]);
        Permission::factory()->create([
            "name" => "logs",
            "icon" => $logs,
            "priority" => 6
        ]);
        Permission::factory()->create([
            "name" => "audit",
            "icon" => $audit,
            "priority" => 7
        ]);
        Permission::factory()->create([
            "name" => "documents",
            "icon" => $documents,
            "priority" => 2
        ]);
        // Super
        UserPermission::factory()->create([
            "view" => true,
            "edit" => true,
            "delete" => true,
            "add" => true,
            "user_id" => 1,
            "permission" => "dashboard"
        ]);
        UserPermission::factory()->create([
            "view" => true,
            "edit" => true,
            "delete" => true,
            "add" => true,
            "user_id" => 1,
            "permission" => "users"
        ]);
        UserPermission::factory()->create([
            "view" => true,
            "edit" => true,
            "delete" => true,
            "add" => true,
            "user_id" => 1,
            "permission" => "settings"
        ]);
        UserPermission::factory()->create([
            "view" => true,
            "edit" => true,
            "delete" => true,
            "add" => true,
            "user_id" => 1,
            "permission" => "reports"
        ]);
        UserPermission::factory()->create([
            "view" => true,
            "edit" => true,
            "delete" => true,
            "add" => true,
            "user_id" => 1,
            "permission" => "audit"
        ]);
        UserPermission::factory()->create([
            "view" => true,
            "edit" => true,
            "delete" => true,
            "add" => true,
            "user_id" => 1,
            "permission" => "documents"
        ]);

        // Debugger
        UserPermission::factory()->create([
            "view" => true,
            "edit" => true,
            "delete" => true,
            "add" => true,
            "user_id" => 2,
            "permission" => "logs"
        ]);

        $this->rolePermission();
    }
    public function statuses()
    {
        $inProgres = Status::factory()->create([
            "name" => "In Progress",
            "color" => "#C0C0C0",
        ]);
        $keep = Status::factory()->create([
            "name" => "Keep",
            "color" => "#008B8B",
        ]);
        $complete = Status::factory()->create([
            "name" => "Complete",
            "color" => "#008000",
        ]);
        $this->Translate("در حال اجرا", "fa", $inProgres->id, Status::class);
        $this->Translate("اجرا په حال کی", "ps", $inProgres->id, Status::class);

        $this->Translate("حفظ", "fa", $keep->id, Status::class);
        $this->Translate("ساتل", "ps", $keep->id, Status::class);

        $this->Translate("تکمیل", "fa", $complete->id, Status::class);
        $this->Translate("بشپړ", "ps", $complete->id, Status::class);
    }
    public function urgencies()
    {
        $urgent = Urgency::factory()->create([
            "name" => "Urgent",
        ]);
        $this->Translate("عاجل", "fa", $urgent->id, Urgency::class);
        $this->Translate("بیړنی", "ps", $urgent->id, Urgency::class);

        $normal = Urgency::factory()->create([
            "name" => "Normal",
        ]);
        $this->Translate("عادی", "fa", $normal->id, Urgency::class);
        $this->Translate("عادی", "ps", $normal->id, Urgency::class);
    }
    public function sources()
    {
        $wezara = Source::factory()->create([
            "name" => "Ministers Directorate",
        ]);
        $this->Translate("ریاست الوزرا", "fa", $wezara->id, Source::class);
        $this->Translate("ریاست الوزرا", "ps", $wezara->id, Source::class);

        $amir = Source::factory()->create([
            "name" => "Amir al-Mu'minin",
        ]);
        $this->Translate("امیرالمؤمنین", "fa", $amir->id, Source::class);
        $this->Translate("امیرالمؤمنین", "ps", $amir->id, Source::class);
    }
    public function settings()
    {
        $day = TimeUnit::factory()->create([
            "name" => "Day",
        ]);
        $this->Translate("روز", "fa", $day->id, TimeUnit::class);
        $this->Translate("ورځ", "ps", $day->id, TimeUnit::class);
        $hour = TimeUnit::factory()->create([
            "name" => "Hour",
        ]);
        $this->Translate("ساعت", "fa", $hour->id, TimeUnit::class);
        $this->Translate("ساعت", "ps", $hour->id, TimeUnit::class);
        $minute = TimeUnit::factory()->create([
            "name" => "Minute",
        ]);
        $this->Translate("دقیقه", "fa", $minute->id, TimeUnit::class);
        $this->Translate("دقیقه", "ps", $minute->id, TimeUnit::class);

        $documentLock = Setting::factory()->create([
            "name" => "document_lock",
            "value" => "1",
        ]);

        SettingTimeUnit::factory()->create([
            "time_unit_id" => $day->id,
            "setting_id" => $documentLock->id,
        ]);
    }
    public function requestTypes()
    {
        $delete = RequestType::factory()->create([
            "name" => "Delete",
            "description" => "Cases which relates to delete operation.",
        ]);
        $this->Translate("حذف", "fa", $delete->id, RequestType::class);
        $this->Translate("لرې کول", "ps", $delete->id, RequestType::class);

        $edit = RequestType::factory()->create([
            "name" => "Edit",
            "description" => "Cases which relates to edit operation.",
        ]);
        $this->Translate("ویرایش", "fa", $edit->id, RequestType::class);
        $this->Translate("سمون", "ps", $edit->id, RequestType::class);

        $view = RequestType::factory()->create([
            "name" => "View",
            "description" => "Cases which relates to view operation.",
        ]);
        $this->Translate("مشاهده", "fa", $view->id, RequestType::class);
        $this->Translate("لید", "ps", $view->id, RequestType::class);


        $unlock = RequestType::factory()->create([
            "name" => "Unlock",
            "description" => "Cases which relates to unlock operation.",
        ]);
        $this->Translate("باز کردن قفل", "fa", $unlock->id, RequestType::class);
        $this->Translate("خلاصول", "ps", $unlock->id, RequestType::class);
    }
    public function documentTypes()
    {
        $hokom = DocumentType::factory()->create([
            "name" => "Command",
        ]);
        $this->Translate("حکم", "fa", $hokom->id, DocumentType::class);
        $this->Translate("حکم", "ps", $hokom->id, DocumentType::class);

        $farman = DocumentType::factory()->create([
            "name" => "Decree",
        ]);
        $this->Translate("فرمان", "fa", $farman->id, DocumentType::class);
        $this->Translate("فرمان", "ps", $farman->id, DocumentType::class);
    }
    public function adverbs()
    {
        $qaidWarida = AdverbType::factory()->create([
            "name" => "Qaid Warida",
        ]);
        $this->Translate("قید وارده", "fa", $qaidWarida->id, AdverbType::class);
        $this->Translate("قید وارده", "ps", $qaidWarida->id, AdverbType::class);

        $qaidSadira = AdverbType::factory()->create([
            "name" => "Qaid Sadira",
        ]);
        $this->Translate("قید صادره", "fa", $qaidSadira->id, AdverbType::class);
        $this->Translate("قید صادره", "ps", $qaidSadira->id, AdverbType::class);
    }
    public function scanTypes()
    {
        $initial = ScanType::factory()->create([
            "name" => "Initial Scan",
        ]);
        $this->Translate("اسکن اولیه", "fa", $initial->id, ScanType::class);
        $this->Translate("اسکن اولیه", "ps", $initial->id, ScanType::class);

        $muqam = ScanType::factory()->create([
            "name" => "After Muqaam Scan",
        ]);
        $this->Translate("اسکن بعد از مقام", "fa", $muqam->id, ScanType::class);
        $this->Translate("اسکن بعد از مقام", "ps", $muqam->id, ScanType::class);
        $final = ScanType::factory()->create([
            "name" => "Final Scan",
        ]);
        $this->Translate("اسکن نهایی", "fa", $final->id, ScanType::class);
        $this->Translate("اسکن نهایی", "ps", $final->id, ScanType::class);
    }
    // Add list of languages here
    public function languages(): void
    {
        Language::factory()->create([
            "name" => "en"
        ]);
        Language::factory()->create([
            "name" => "ps"
        ]);
        Language::factory()->create([
            "name" => "fa"
        ]);
    }
    // Add list of countries here
    public function destinations($directorate): void
    {
        // Change destination types
        $destination = [

            "Directorate of Information Technology" => [
                "fa" => "ریاست تکنالوژی معلوماتی ",
                "ps" => "د معلوماتي ټکنالوژۍ ریاست",
            ],
            "General Directorate of Office, Documentation, and Communication" => [
                "fa" => "ریاست عمومی دفتر٬ اسناد و ارتباط",
                "ps" => "د ارتباطاتو، اسنادو او دفتر لوی ریاست",
            ],

            "Directorate of Information, Public Relations, and Spokesperson" => [
                "fa" => "ریاست اطلاعات٬ ارتباط عامه و سخنگو  ",
                "ps" => "د ارتباطاتو، عامه اړیکو او ویاندویۍ ریاست  ",
            ],

            "Directorate of preaching and Guidance " => [
                "fa" => " ریاست دعوت و ارشاد ",
                "ps" => "د ارشاد او دعوت ریاست  ",
            ],

            "Directorate of Internal Audit" => [
                "fa" => " ریاست تفتیش داخلی ",
                "ps" => "د داخلي پلتڼې ریاست",
            ],

            "General Directorate of Supervision and Inspection" => [
                "fa" => " ریاست عمومی نظارت و بازرسی ",
                "ps" => "د نظارت او ارزیابۍ لوی ریاست  ",
            ],

            "Directorate of Evaluation, Analysis, and Data Interpretation" => [
                "fa" => " ریاست ارزیابی ٬ تحلیل و تجزیه ارقام ",
                "ps" => "د ارقامو د تحلیل تجزیي او ارزیابۍ ریاست  ",
            ],

            "Directorate of Medicine and Food Inspection" => [
                "fa" => "ریاست نظارت و بازرسی از ادویه و مواد غذایی",
                "ps" => "د خوړو او درملو د نظارت او ارزیابۍ ریاست ",
            ],

            "Directorate of Health Service Delivery Inspection" => [
                "fa" => " ریاست نظارت و بازرسی ازعرضه خدمات صحی ",
                "ps" => "  د روغتیايي خدمتونو څخه د نظارت او ارزیابۍ ریاست",
            ],

            "Directorate of Health Facility Assessment" => [
                "fa" => " ریاست بررسی از تاسیسات صحی  ",
                "ps" => "د روغتیايي تاسیساتو د څېړنې ریاست  ",
            ],

            "Directorate of International Relations, Coordination, and Aid Management" => [
                "fa" => "ریاست روابط بین المللی٬ هماهنگی وانسجام کمکها ",
                "ps" => " ریاست روابط بین المللی٬ هماهنگی وانسجام کمکها ",
            ],

            "General Directorate of the Medical Council" => [
                "fa" => " ریاست عمومی شورای طبی ",
                "ps" => " د طبي شورا لوی ریاست  ",
            ],

            "Directorate of Medical Ethics and Standards Promotion" => [
                "fa" => " ریاست اخلاق طبابت و ترویج استندرد ها ",
                "ps" => "د معیارونو د پلي کولو او  طبي اخلاقو ریاست  ",
            ],

            "Directorate of Regulation for Nurses, Midwives, and Other Medical Personnel" => [
                "fa" => " ریاست تنظیم امور نرسها٬قابله ها وسایر پرسونل طبی",
                "ps" => "د نرسانو، قابله ګانو او ورته نورو طبي کارکوونکو د چارو د ترتیب ریاست ",
            ],

            "Directorate of Licensing and Registration for Doctors and Health Personnel" => [
                "fa" => "ریاست ثبت و صدور جواز فعالیت امور دوکتوران و سایر پرسونل صحی ",
                "ps" => "د روغتیايي کارکوونکو او ورته نور طبي پرسونل د فعالیت جوازونو د ثبت او صدور ریاست ",
            ],

            "Directorate of Provincial Health Coordination" => [
                "fa" => "ریاست هماهنگی صحت ولایات ",
                "ps" => "د ولایتونو د روغتیا همغږۍ ریاست ",
            ],

            "General Directorate of Curative Medicine" => [
                "fa" => "ریاست عمومی طب معالجوی  ",
                "ps" => "د معالجوي طب لوی ریاست",
            ],

            "Directorate of Diagnostic Services" => [
                "fa" => " ریاست خدمات تشخیصیه",
                "ps" => "د تشخیصیه خدماتو ریاست",
            ],

            "Directorate of National Addiction Treatment Program" => [
                "fa" => "ریاست برنامه ملی تداوی معتادین ",
                "ps" => "د روږدو درملنې ملي برنامې ریاست",
            ],

            "General Directorate of Preventive Medicine and Disease Control" => [
                "fa" => "ریاست عمومی طب وقایه و کنترول امراض ",
                "ps" => "د ناروغیو د مخنیوي او کنټرول لوی ریاست",
            ],

            "Directorate of Primary Health Care (PHC)" => [
                "fa" => " ریاست مراقبتهای صحی اولیهPHC",
                "ps" => "  د روغتیا لومړنیو پاملرنو ریاست PHC  ",
            ],

            "Directorate of Environmental Health" => [
                "fa" => "ریاست صحت محیطی ",
                "ps" => "د چاپیریال روغتیا ریاست",
            ],

            "Directorate of Infectious Disease Control" => [
                "fa" => " ریاست کنترول امراض ساری",
                "ps" => "د ساري ناروغیو د کنټرول ریاست",
            ],

            "Directorate of Mobile Health Services" => [
                "fa" => " ریاست مراقبت های صحی سیار",
                "ps" => "د ګرځنده روغتیايي خدمتونو ریاست",
            ],

            "Directorate of Public Nutrition" => [
                "fa" => "ریاست تغذی عامه ",
                "ps" => "د عامه تغذیې ریاست",
            ],

            "Directorate of Maternal, Newborn, and Child Health" => [
                "fa" => " ریاست صحت باروری مادر٬ نوزاد و طفل",
                "ps" => "د کوچنیانو، نویو زیږېدلو او بارورۍ روغتیا ریاست",
            ],

            "Directorate of Forensic Medicine" => [
                "fa" => "ریاست طب عدلی ",
                "ps" => "د عدلي طب ریاست",
            ],

            "Department of Emergency Management" => [
                "fa" => " آمریت رسیدگی به حوادث غیرمترقبه",
                "ps" => "ناڅاپي پېښو ته د رسېدنې آمریت",
            ],

            "Directorate of Private Sector Coordination" => [
                "fa" => "ریاست تنظیم هماهنگی سکتور خصوصی ",
                "ps" => "د خصوصي سکتور د همغږۍ او تنظیم ریاست",
            ],

            "General Directorate of the National Public Health Institute" => [
                "fa" => " ریاست عمومی انیستیتوت ملی صحت عامه ",
                "ps" => "د عامې روغتیا ملي انسټېټیوټ لوی ریاست",
            ],

            "Directorate of Public Health Education and Management" => [
                "fa" => "ریاست آموزش صحت عامه و مدیریت  ",
                "ps" => "د عامه روغتیايي زده کړو او مدیریت ریاست",
            ],

            "Directorate of Public Health Research and Clinical Studies" => [
                "fa" => " ریاست تحقیقات صحت عامه و مطالعات کلینیکی",
                "ps" => "د کلینیکي مطالعاتو او عامې روغتیا د څېړنو ریاست",
            ],

            "General Directorate of Policy and Planning" => [
                "fa" => " ریاست عمومی پالیسی و پلان",
                "ps" => "د پلان او پالیسۍ لوی ریاست",
            ],

            "Directorate of Planning and Strategic Planning" => [
                "fa" => " ریاست برنامه ریزی و پلانگذاری",
                "ps" => "د برنامه ریزۍ او پلانګزارۍ ریاست",
            ],

            "Directorate of Health Economics and Funding" => [
                "fa" => " ریاست اقتصاد و تمویل صحت ",
                "ps" => "د روغتیا د تمویل او اقتصاد ریاست",
            ],

            "Executive Directorate of the National Accreditation Authority for Health Facilities" => [
                "fa" => "ریاست اجرائیوی اداره ملی اعتبار دهی مراکز صحی  ",
                "ps" => "د روغتیايي مرکزونو د اعتبار ورکولو ملي ادارې اجرائیوي ریاست",
            ],

            "Directorate of Public-Private Partnership" => [
                "fa" => " ریاست مشارکت عامه و خصوصی",
                "ps" => "د خصوصي او عامه مشارکت ریاست",
            ],

            "Directorate of Protection of Children and Maternal Health Rights" => [
                "fa" => "ریاست حمایت از حقوق صحی اطفال و مادران ",
                "ps" => "د کوچنیانو او مېندو له روغتیايي حقوقو څخه د تمویل ریاست",
            ],

            "Directorate of Legal Affairs and Legislation" => [
                "fa" => "ریاست امور حقوقی و تقنین ",
                "ps" => "د تقنین او حقوقي چارو ریاست",
            ],

            "General Directorate of Pharmaceutical and Health Products Regulation" => [
                "fa" => " ریاست عمومی تنظیم ادویه و محصولات صحی ",
                "ps" => "د درملو او روغتیايي محصولاتو د ترتیب لوی ریاست",
            ],

            "Directorate of Licensing for Pharmaceutical Facilities and Activities" => [
                "fa" => " ریاست جوازدهی به تاسیسات و فعالیت های دوایی",
                "ps" => "تاسیساتو ته د جوازونو د ورکړې او درملیزو فعالیتونو ریاست",
            ],

            "Directorate of Drug and Health Product Evaluation and Registration" => [
                "fa" => "ریاست ارزیابی و ثبت ادویه و محصولات صحی ",
                "ps" => "د درملواو روغتیايي محصولاتو د ثبت او څېړنې ریاست",
            ],

            "Directorate of Pharmaceutical and Health Product Import and Export Regulation
            " => [
                "fa" => "ریاست تنطیم صادرات و واردات ادویه ومحصولات صحی ",
                "ps" => "د روغتیايي محصولاتو او درملو د صادرولو او وارداتو د تنظیم ریاست",
            ],

            "General Directorate of Food Safety" => [
                "fa" => "ریاست عمومی مصؤنیت غذایی ",
                "ps" => "د خوړو د ساتلو لوی ریاست",
            ],

            "Directorate of Food Licensing and Registration" => [
                "fa" => "ریاست جوازدهی و ثبت مواد غذایی ",
                "ps" => "د خوراکي توکو د ثبت او جوازونو ورکولو ریاست",
            ],

            "Directorate of Food Surveillance, Risk Analysis, and Standards Development" => [
                "fa" => " ریاست تحلیل خطر سرویلانس مواد غذایی وتدوین استندردها",
                "ps" => "د سرویلانس خطرونو او خوراکي توکو د څېړنو او د معیارونو پلي کولو ریاست",
            ],

            "Directorate of Document Analysis and Activity Regulation" => [
                "fa" => "ریاست تحلیل اسناد و تنظیم فعالیت ها ",
                "ps" => "د فعالیتونو د تنظیم او د اسنادو د څېړلو ریاست",
            ],

            "Directorate of Food, Drug, and Health Product Quality Control (Laboratory)" => [
                "fa" => " ریاست کنترول کیفیت غذا ٬ ادویه و محصولات صحی (لابراتوار)",
                "ps" => "د روغتیا لابراتواري محصولاتو،درملو او خوراکي توکو د کیفیت کنټرول ریاست ",
            ],

            "Directorate of Pharmaceutical Services" => [
                "fa" => "ریاست خدمات دوایی ",
                "ps" => "د درملي خدمتونو ریاست",
            ],

            "Directorate of Overseas Health Coordination Centers" => [
                "fa" => "ریاست هماهنگ کننده مراکز صحی خارج از کشور ",
                "ps" => "له هېواده بهر روغتیايي مرکزونو د همغږۍ ریاست",
            ],

            "Directorate of Overseas Health Affairs – Karachi" => [
                "fa" => " ریاست امور صحی خارج مرز کراچی",
                "ps" => "له هېواده بهر د کراچۍ د روغتیايي چارو ریاست",
            ],

            "Directorate of Overseas Health Affairs – Peshawar" => [
                "fa" => " ریاست امورصحی خارج مرز پشاور",
                "ps" => "له هېواده بهر پشاور د روغتیايي چارو ریاست",
            ],

            "Directorate of Overseas Health Affairs – Quetta" => [
                "fa" => "ریاست امورصحی خارج مرز کوته ",
                "ps" => "له هېواده بهر کوټه د روغتیايي چارو ریاست",
            ],

            "Directorate of Finance and Accounting" => [
                "fa" => "ریاست امور مالی و حسابی  ",
                "ps" => "د مالي او حسابي چارو ریاست",
            ],

            "Directorate of Procurement" => [
                "fa" => "ریاست تدارکات ",
                "ps" => "  د تدارکاتو ریاست  ",
            ],


            "Directorate of Administration" => [
                "fa" => "ریاست اداری",
                "ps" => "اداري ریاست",
            ],


            "General Directorate of Human Resources" => [
                "fa" => "ریاست عمومی منابع بشری ",
                "ps" => "د بشري سرچینو لوی ریاست",
            ],


            "Directorate of Capacity Building" => [
                "fa" => "ریاست ارتقای ظرفیت  ",
                "ps" => "د ظرفیت لوړلو ریاست",
            ],


            "Directorate of Prof. Ghazanfar Institute of Health Sciences" => [
                "fa" => "ریاست انیستیتوت علوم صحی پوهاند غضنفر ",
                "ps" => "د پوهاند غنضنفر روغتیايي علومو انسټېټیوټ ریاست",
            ],

            "Directorate of Private Health Sciences Institutes" => [
                "fa" => "ریاست انیستیتوت های علوم صحی خصوصی ",
                "ps" => "د خصوصي روغتیايي علومو انسټېټیوټونو ریاست",
            ],

            "General Directorate of Specialty" => [
                "fa" => " ریاست عمومی اکمال تخصص",
                "ps" => "د اکمال تخصص لوی ریاست",
            ],

            "Directorate of Operations" => [
                "fa" => "  ریاست عملیاتی",
                "ps" => "عملیاتي ریاست",
            ],

            "Directorate of Academic Coordination" => [
                "fa" => "  ریاست امور انسجام اکادمیک",
                "ps" => "د اکاډمیکو چارو د انسجام ریاست",

            ],
        ];
        foreach ($destination as $name => $destinations) {
            // Create the country record
            $dst = Destination::factory()->create([
                "name" => trim($name),
                "color" => "#B4D455",
                "destination_type_id" => $directorate->id,
            ]);
            // Loop through translations (e.g., fa, ps)
            foreach ($destinations as $key => $value) {
                $this->Translate($value, $key, $dst->id, Destination::class);
                $this->Translate(trim($value), trim($key), $dst->id, Destination::class);
            }
        }
    }
    public function offic($offic): void
    {
        // Change destination types
        $destination = [
            "Deputy Ministry of Health Service Delivery" => [
                "fa" => " معینیت عرضه خدمات صحی",
                "ps" => "د روغتیايي خدمتونو وړاندې کولو معینیت",
            ],
            "Deputy Ministry of Medicine and Food" => [
                "fa" => "معینیت دوا و غذا  ",
                "ps" => "د حوړو او درملو معینیت",
            ],
            "Ministers Office" => [
                "fa" => "مقام وزارت ",
                "ps" => "د وزارت مقام",
            ],
            "Deputy Ministry of Finance and Administration" => [
                "fa" => " معینیت مالی و اداری ",
                "ps" => "د مالي او اداري چارو معینیت",
            ],
            "Deputy Ministry of Health Policy and Development" => [
                "fa" => "معینیت پالیسی و انکشاف صحت  ",
                "ps" => "د روغتیايي پراختیا او پالیسۍ معینیت",
            ],
        ];
        foreach ($destination as $name => $destinations) {
            // Create the country record
            $dst = Destination::factory()->create([
                "name" => trim($name),
                "color" => "#B4D455",
                "destination_type_id" => $offic->id,
            ]);
            // Loop through translations (e.g., fa, ps)
            foreach ($destinations as $key => $value) {
                $this->Translate($value, $key, $dst->id, Destination::class);
                $this->Translate(trim($value), trim($key), $dst->id, Destination::class);
            }
        }
    }
    public function rolePermission()
    {
        // Super permission
        RolePermission::factory()->create([
            "view" => true,
            "edit" => true,
            "delete" => true,
            "add" => true,
            "role" => RoleEnum::super,
            "permission" => "dashboard"
        ]);
        RolePermission::factory()->create([
            "view" => true,
            "edit" => true,
            "delete" => true,
            "add" => true,
            "role" => RoleEnum::super,
            "permission" => "users"
        ]);
        RolePermission::factory()->create([
            "view" => true,
            "edit" => true,
            "delete" => true,
            "add" => true,
            "role" => RoleEnum::super,
            "permission" => "settings"
        ]);
        RolePermission::factory()->create([
            "view" => true,
            "edit" => true,
            "delete" => true,
            "add" => true,
            "role" => RoleEnum::super,
            "permission" => "reports"
        ]);
        RolePermission::factory()->create([
            "view" => true,
            "edit" => true,
            "delete" => true,
            "add" => true,
            "role" => RoleEnum::super,
            "permission" => "audit"
        ]);
        RolePermission::factory()->create([
            "view" => true,
            "edit" => true,
            "delete" => true,
            "add" => true,
            "role" => RoleEnum::super,
            "permission" => "documents"
        ]);
        // Debugger
        RolePermission::factory()->create([
            "view" => true,
            "edit" => true,
            "delete" => true,
            "add" => true,
            "role" => RoleEnum::debugger,
            "permission" => "logs"
        ]);
        // Admin permission
        RolePermission::factory()->create([
            "view" => true,
            "edit" => true,
            "delete" => true,
            "add" => true,
            "role" => RoleEnum::admin,
            "permission" => "dashboard"
        ]);
        RolePermission::factory()->create([
            "view" => true,
            "edit" => true,
            "delete" => true,
            "add" => true,
            "role" => RoleEnum::admin,
            "permission" => "users"
        ]);
        RolePermission::factory()->create([
            "view" => true,
            "edit" => true,
            "delete" => true,
            "add" => true,
            "role" => RoleEnum::admin,
            "permission" => "settings"
        ]);
        RolePermission::factory()->create([
            "view" => true,
            "edit" => true,
            "delete" => true,
            "add" => true,
            "role" => RoleEnum::admin,
            "permission" => "reports"
        ]);
        RolePermission::factory()->create([
            "view" => true,
            "edit" => true,
            "delete" => true,
            "add" => true,
            "role" => RoleEnum::admin,
            "permission" => "documents"
        ]);
        // User permission
        RolePermission::factory()->create([
            "view" => true,
            "edit" => true,
            "delete" => true,
            "add" => true,
            "role" => RoleEnum::user,
            "permission" => "dashboard"
        ]);
        RolePermission::factory()->create([
            "view" => true,
            "edit" => true,
            "delete" => true,
            "add" => true,
            "role" => RoleEnum::user,
            "permission" => "reports"
        ]);
        RolePermission::factory()->create([
            "view" => true,
            "edit" => true,
            "delete" => true,
            "add" => true,
            "role" => RoleEnum::user,
            "permission" => "documents"
        ]);
    }

    // Add list of districts here
    public function Translate($value, $language, $translable_id, $translable_type): void
    {
        Translate::factory()->create([
            "value" => $value,
            "language_name" => $language,
            "translable_type" => $translable_type,
            "translable_id" => $translable_id,
        ]);
    }
}
