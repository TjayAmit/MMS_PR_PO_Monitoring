<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use App\Models\Department;

class DepartmentTableSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        Department::truncate();

        Department::create([
            'dept_PK_msc_warehouse' => 1000,
            'dept_name' => 'ZCMC_ADMIN',
            'dept_shortname' => "ADMIN",
        ]);
        
        Department::create([
            'dept_PK_msc_warehouse' => 1001,
            'dept_name' => 'Cardiovascular',
            'dept_shortname' => "Cardiovascular",
        ]);
        
        Department::create([
            'dept_PK_msc_warehouse' => 1002,
            'dept_name' => 'Accounting',
            'dept_shortname' => "Accounting",
        ]);
        
        Department::create([
            'dept_PK_msc_warehouse' => 1003,
            'dept_name' => 'Admitting',
            'dept_shortname' => "NONE",
        ]);
        
        Department::create([
            'dept_PK_msc_warehouse' => 1004,
            'dept_name' => 'Anesthesia Department',
            'dept_shortname' => "Anesthesia",
        ]);
        
        Department::create([
            'dept_PK_msc_warehouse' => 1005,
            'dept_name' => 'Procurement Section',
            'dept_shortname' => "Procurement Section",
        ]);
        
        Department::create([
            'dept_PK_msc_warehouse' => 1006,
            'dept_name' => 'Bacteriology',
            'dept_shortname' => "Bacteriology",
        ]);
        
        Department::create([
            'dept_PK_msc_warehouse' => 1007,
            'dept_name' => 'Billing',
            'dept_shortname' => "Billing",
        ]);
        
        Department::create([
            'dept_PK_msc_warehouse' => 1008,
            'dept_name' => 'Biomed',
            'dept_shortname' => "Biomed",
        ]);
        
        Department::create([
            'dept_PK_msc_warehouse' => 1009,
            'dept_name' => 'Birthing Clinic',
            'dept_shortname' => "Birthing Clinic",
        ]);
        
        Department::create([
            'dept_PK_msc_warehouse' => 1010,
            'dept_name' => 'Blood Bank',
            'dept_shortname' => "Blood Bank",
        ]);
        
        Department::create([
            'dept_PK_msc_warehouse' => 1011,
            'dept_name' => 'Budget',
            'dept_shortname' => "Budget",
        ]);
        
        Department::create([
            'dept_PK_msc_warehouse' => 1012,
            'dept_name' => 'Cashier MAIN',
            'dept_shortname' => "Cashier",
        ]);
        
        Department::create([
            'dept_PK_msc_warehouse' => 1013,
            'dept_name' => 'Chief of Clinics',
            'dept_shortname' => "Chief Clinics",
        ]);
        
        Department::create([
            'dept_PK_msc_warehouse' => 1014,
            'dept_name' => 'Commission on Audit',
            'dept_shortname' => "COA",
        ]);
        
        Department::create([
            'dept_PK_msc_warehouse' => 1015,
            'dept_name' => 'Central Supply',
            'dept_shortname' => "CSR",
        ]);
        
        Department::create([
            'dept_PK_msc_warehouse' => 1016,
            'dept_name' => 'CT Scan',
            'dept_shortname' => "Ct Scan",
        ]);
        
        Department::create([
            'dept_PK_msc_warehouse' => 1017,
            'dept_name' => 'Delivery Room',
            'dept_shortname' => "DR",
        ]);
        
        Department::create([
            'dept_PK_msc_warehouse' => 1018,
            'dept_name' => 'Dental',
            'dept_shortname' => "Dental",
        ]);
        
        Department::create([
            'dept_PK_msc_warehouse' => 1019,
            'dept_name' => 'Dialysis',
            'dept_shortname' => "Dialysis",
        ]);
        
        Department::create([
            'dept_PK_msc_warehouse' => 1020,
            'dept_name' => 'Nutrition and Dietetics',
            'dept_shortname' => "Dietary",
        ]);
        
        Department::create([
            'dept_PK_msc_warehouse' => 1021,
            'dept_name' => 'Drug Testing',
            'dept_shortname' => "Drug Testing",
        ]);
        
        Department::create([
            'dept_PK_msc_warehouse' => 1022,
            'dept_name' => 'Emergency Room',
            'dept_shortname' => "ER",
        ]);
        
        Department::create([
            'dept_PK_msc_warehouse' => 1023,
            'dept_name' => 'Eye Center OPD',
            'dept_shortname' => "Eye Center",
        ]);
        
        Department::create([
            'dept_PK_msc_warehouse' => 1024,
            'dept_name' => 'Health Emergency Management Staff',
            'dept_shortname' => "HEMS",
        ]);
        
        Department::create([
            'dept_PK_msc_warehouse' => 1025,
            'dept_name' => 'Housekeeping',
            'dept_shortname' => "Housekeeping",
        ]);
        
        Department::create([
            'dept_PK_msc_warehouse' => 1026,
            'dept_name' => 'Medical Intesive Care Unit',
            'dept_shortname' => "MICU",
        ]);
        
        Department::create([
            'dept_PK_msc_warehouse' => 1027,
            'dept_name' => 'Infra',
            'dept_shortname' => "Infra",
        ]);
        
        Department::create([
            'dept_PK_msc_warehouse' => 1028,
            'dept_name' => 'Laboratory',
            'dept_shortname' => "Lab",
        ]);
        
        Department::create([
            'dept_PK_msc_warehouse' => 1029,
            'dept_name' => 'Laundry',
            'dept_shortname' => "Laundry",
        ]);
        
        Department::create([
            'dept_PK_msc_warehouse' => 1030,
            'dept_name' => 'Library',
            'dept_shortname' => "Library",
        ]);
        
        Department::create([
            'dept_PK_msc_warehouse' => 1031,
            'dept_name' => 'Engineering and Facility Management',
            'dept_shortname' => "EFM",
        ]);
        
        Department::create([
            'dept_PK_msc_warehouse' => 1032,
            'dept_name' => 'Medical Social Service',
            'dept_shortname' => "MSS",
        ]);
        
        Department::create([
            'dept_PK_msc_warehouse' => 1033,
            'dept_name' => 'Health Management Information Office',
            'dept_shortname' => "Health Management Information",
        ]);
        
        Department::create([
            'dept_PK_msc_warehouse' => 1034,
            'dept_name' => 'Management Information System/Information Tech',
            'dept_shortname' => "MIS/IT",
        ]);
        
        Department::create([
            'dept_PK_msc_warehouse' => 1035,
            'dept_name' => 'Neonatal Intesive Care Unit',
            'dept_shortname' => "NICU",
        ]);
        
        Department::create([
            'dept_PK_msc_warehouse' => 1036,
            'dept_name' => 'Nursing Office',
            'dept_shortname' => "NSO",
        ]);
        
        Department::create([
            'dept_PK_msc_warehouse' => 1037,
            'dept_name' => 'OPD Triage',
            'dept_shortname' => "OPD Triage",
        ]);
        
        Department::create([
            'dept_PK_msc_warehouse' => 1038,
            'dept_name' => 'Operating Room',
            'dept_shortname' => "OR",
        ]);
        
        Department::create([
            'dept_PK_msc_warehouse' => 1039,
            'dept_name' => 'Public Affairs and Customer Care Unit',
            'dept_shortname' => "PACCU",
        ]);
        
        Department::create([
            'dept_PK_msc_warehouse' => 1040,
            'dept_name' => 'Post Anesthesia Care Unit (PACU)',
            'dept_shortname' => "PACU",
        ]);
        
        Department::create([
            'dept_PK_msc_warehouse' => 1041,
            'dept_name' => 'Payroll',
            'dept_shortname' => "Payroll",
        ]);
        
        Department::create([
            'dept_PK_msc_warehouse' => 1042,
            'dept_name' => 'Personnel',
            'dept_shortname' => "Personnel",
        ]);
        
        Department::create([
            'dept_PK_msc_warehouse' => 1043,
            'dept_name' => 'Pharmacy',
            'dept_shortname' => "Pharmacy",
        ]);
        
        Department::create([
            'dept_PK_msc_warehouse' => 1044,
            'dept_name' => 'Philhealth',
            'dept_shortname' => "PHIC",
        ]);
        
        Department::create([
            'dept_PK_msc_warehouse' => 1045,
            'dept_name' => 'Powerhouse',
            'dept_shortname' => "Powerhouse",
        ]);
        
        Department::create([
            'dept_PK_msc_warehouse' => 1046,
            'dept_name' => 'PRCM',
            'dept_shortname' => "PRCM",
        ]);
        
        Department::create([
            'dept_PK_msc_warehouse' => 1047,
            'dept_name' => 'Public Health Unit',
            'dept_shortname' => "PHU",
        ]);
        
        Department::create([
            'dept_PK_msc_warehouse' => 1048,
            'dept_name' => 'Pulmonary',
            'dept_shortname' => "Pulmonary",
        ]);
        
        Department::create([
            'dept_PK_msc_warehouse' => 1049,
            'dept_name' => 'Radio Oncology',
            'dept_shortname' => "Radio Oncology",
        ]);
        
        Department::create([
            'dept_PK_msc_warehouse' => 1050,
            'dept_name' => 'Rehabilitation Center',
            'dept_shortname' => "Rehab",
        ]);
        
        Department::create([
            'dept_PK_msc_warehouse' => 1051,
            'dept_name' => 'Room 1 Medicine',
            'dept_shortname' => "Room 1",
        ]);
        
        Department::create([
            'dept_PK_msc_warehouse' => 1052,
            'dept_name' => 'Room 2 OB-Gyne',
            'dept_shortname' => "Room 2",
        ]);
        
        Department::create([
            'dept_PK_msc_warehouse' => 1053,
            'dept_name' => 'Room 3 Surgery',
            'dept_shortname' => "Room 3",
        ]);
        
        Department::create([
            'dept_PK_msc_warehouse' => 1054,
            'dept_name' => 'Room 6 Family Medicince',
            'dept_shortname' => "Room 6",
        ]);
        
        Department::create([
            'dept_PK_msc_warehouse' => 1055,
            'dept_name' => 'Senior Citizen Ward',
            'dept_shortname' => "SCW",
        ]);
        
        Department::create([
            'dept_PK_msc_warehouse' => 1056,
            'dept_name' => 'Supply',
            'dept_shortname' => "Supply",
        ]);
        
        Department::create([
            'dept_PK_msc_warehouse' => 1057,
            'dept_name' => 'PETRO',
            'dept_shortname' => "PETRO",
        ]);
        
        Department::create([
            'dept_PK_msc_warehouse' => 1058,
            'dept_name' => 'Ultrasound',
            'dept_shortname' => "UTZ",
        ]);
        
        Department::create([
            'dept_PK_msc_warehouse' => 1059,
            'dept_name' => 'Room 10 Under 5 Clinic',
            'dept_shortname' => "Room 10",
        ]);
        
        Department::create([
            'dept_PK_msc_warehouse' => 1060,
            'dept_name' => 'OB-Gyne (Ward 1)',
            'dept_shortname' => "Ward 1",
        ]);
        
        Department::create([
            'dept_PK_msc_warehouse' => 1061,
            'dept_name' => 'Orthopedics/Neuro Ward (Ward 2 & 3)',
            'dept_shortname' => "Ward 2/3",
        ]);
        
        Department::create([
            'dept_PK_msc_warehouse' => 1062,
            'dept_name' => 'Surgery Ward (Ward 4)',
            'dept_shortname' => "Ward 4",
        ]);
        
        Department::create([
            'dept_PK_msc_warehouse' => 1063,
            'dept_name' => 'Internal Medicine Ward (WARD 5)',
            'dept_shortname' => "Ward 5",
        ]);
        
        Department::create([
            'dept_PK_msc_warehouse' => 1064,
            'dept_name' => 'Infectious Ward (Ward 6)',
            'dept_shortname' => "Ward 6",
        ]);
        
        Department::create([
            'dept_PK_msc_warehouse' => 1065,
            'dept_name' => 'Pediatrics Ward (Ward8)',
            'dept_shortname' => "Ward 8",
        ]);
        
        Department::create([
            'dept_PK_msc_warehouse' => 1066,
            'dept_name' => 'Psychiatric Ward (Ward 9)',
            'dept_shortname' => "Ward 9",
        ]);
        
        Department::create([
            'dept_PK_msc_warehouse' => 1067,
            'dept_name' => 'X-ray',
            'dept_shortname' => "X-ray",
        ]);
        
        Department::create([
            'dept_PK_msc_warehouse' => 1068,
            'dept_name' => 'Heart Clinic',
            'dept_shortname' => "Heart Clinic",
        ]);
        
        Department::create([
            'dept_PK_msc_warehouse' => 1069,
            'dept_name' => 'ENT',
            'dept_shortname' => "NONE",
        ]);
        
        Department::create([
            'dept_PK_msc_warehouse' => 1070,
            'dept_name' => 'Temp Station',
            'dept_shortname' => "NONE",
        ]);
        
        Department::create([
            'dept_PK_msc_warehouse' => 1071,
            'dept_name' => 'Material Management Section',
            'dept_shortname' => "Material Management Section",
        ]);
        
        Department::create([
            'dept_PK_msc_warehouse' => 1072,
            'dept_name' => 'CMPS',
            'dept_shortname' => "CMPS",
        ]);
        
        Department::create([
            'dept_PK_msc_warehouse' => 1073,
            'dept_name' => 'PMDT',
            'dept_shortname' => "PMDT",
        ]);
        
        Department::create([
            'dept_PK_msc_warehouse' => 1074,
            'dept_name' => 'Internal Medicine Follow-up Clinic',
            'dept_shortname' => "NONE",
        ]);
        
        Department::create([
            'dept_PK_msc_warehouse' => 1075,
            'dept_name' => 'Medical Center Chief Office',
            'dept_shortname' => "MMCO",
        ]);
        
        Department::create([
            'dept_PK_msc_warehouse' => 1076,
            'dept_name' => 'CAO Office',
            'dept_shortname' => "CAO Office",
        ]);
        
        Department::create([
            'dept_PK_msc_warehouse' => 1077,
            'dept_name' => 'Magnetic Resonance Imaging',
            'dept_shortname' => "MRI",
        ]);
        
        Department::create([
            'dept_PK_msc_warehouse' => 1078,
            'dept_name' => 'Human Milk Bank',
            'dept_shortname' => "H.M.U.",
        ]);
        
        Department::create([
            'dept_PK_msc_warehouse' => 1079,
            'dept_name' => 'Warehouse MEDICINES',
            'dept_shortname' => "NONE",
        ]);
        
        Department::create([
            'dept_PK_msc_warehouse' => 1080,
            'dept_name' => 'Legal office',
            'dept_shortname' => "NONE",
        ]);
        
        Department::create([
            'dept_PK_msc_warehouse' => 1081,
            'dept_name' => 'Central Supply & Sterilization Warehouse',
            'dept_shortname' => "Central Supply & Sterilization",
        ]);
        
        Department::create([
            'dept_PK_msc_warehouse' => 1082,
            'dept_name' => 'Internal Control Unit',
            'dept_shortname' => "NONE",
        ]);
        
        Department::create([
            'dept_PK_msc_warehouse' => 1083,
            'dept_name' => 'Security',
            'dept_shortname' => "NONE",
        ]);
        
        Department::create([
            'dept_PK_msc_warehouse' => 1084,
            'dept_name' => 'Human Resource Management Office',
            'dept_shortname' => "HRMO",
        ]);
        
        Department::create([
            'dept_PK_msc_warehouse' => 1085,
            'dept_name' => 'Surgery Department',
            'dept_shortname' => "NONE",
        ]);
        
        Department::create([
            'dept_PK_msc_warehouse' => 1086,
            'dept_name' => 'Internal Medicine Department',
            'dept_shortname' => "NONE",
        ]);
        
        Department::create([
            'dept_PK_msc_warehouse' => 1087,
            'dept_name' => 'WCPU',
            'dept_shortname' => "NONE",
        ]);
        
        Department::create([
            'dept_PK_msc_warehouse' => 1088,
            'dept_name' => 'TB-DOTS',
            'dept_shortname' => "NONE",
        ]);
        
        Department::create([
            'dept_PK_msc_warehouse' => 1089,
            'dept_name' => 'Ophthalmology Department',
            'dept_shortname' => "NONE",
        ]);
        
        Department::create([
            'dept_PK_msc_warehouse' => 1090,
            'dept_name' => 'OB-Gyne Operating Room',
            'dept_shortname' => "NONE",
        ]);
        
        Department::create([
            'dept_PK_msc_warehouse' => 1091,
            'dept_name' => 'Injection Room',
            'dept_shortname' => "NONE",
        ]);
        
        Department::create([
            'dept_PK_msc_warehouse' => 1092,
            'dept_name' => 'Ward 1',
            'dept_shortname' => "NONE",
        ]);
        
        Department::create([
            'dept_PK_msc_warehouse' => 1093,
            'dept_name' => 'Ward 2',
            'dept_shortname' => "NONE",
        ]);
        
        Department::create([
            'dept_PK_msc_warehouse' => 1094,
            'dept_name' => 'Ward 4',
            'dept_shortname' => "NONE",
        ]);
        
        Department::create([
            'dept_PK_msc_warehouse' => 1095,
            'dept_name' => 'Ward 5',
            'dept_shortname' => "NONE",
        ]);
        
        Department::create([
            'dept_PK_msc_warehouse' => 1096,
            'dept_name' => 'Communicable Ward (Ward 7)',
            'dept_shortname' => "NONE",
        ]);
        
        Department::create([
            'dept_PK_msc_warehouse' => 1096,
            'dept_name' => 'Ward 8',
            'dept_shortname' => "NONE",
        ]);
        
        Department::create([
            'dept_PK_msc_warehouse' => 1097,
            'dept_name' => 'Ward 9',
            'dept_shortname' => "NONE",
        ]);
        
        Department::create([
            'dept_PK_msc_warehouse' => 1099,
            'dept_name' => 'Document Control Office',
            'dept_shortname' => "Document Control Office",
        ]);
        
        Department::create([
            'dept_PK_msc_warehouse' => 1100,
            'dept_name' => 'SICU',
            'dept_shortname' => "NONE",
        ]);
        
        Department::create([
            'dept_PK_msc_warehouse' => 1101,
            'dept_name' => 'Infection Prevention and Control Committee',
            'dept_shortname' => "IPCC",
        ]);
        
        Department::create([
            'dept_PK_msc_warehouse' => 1102,
            'dept_name' => 'Pharmacy STOP DEATH',
            'dept_shortname' => "Pharmacy STOP DEATH",
        ]);
        
        Department::create([
            'dept_PK_msc_warehouse' => 1103,
            'dept_name' => 'Pharmacy OPD',
            'dept_shortname' => "Pharmacy OPD",
        ]);
        
        Department::create([
            'dept_PK_msc_warehouse' => 1104,
            'dept_name' => 'Family Planning',
            'dept_shortname' => "Family Planning",
        ]);
        
        Department::create([
            'dept_PK_msc_warehouse' => 1105,
            'dept_name' => 'Research Unit',
            'dept_shortname' => "Research Unit",
        ]);
        
        Department::create([
            'dept_PK_msc_warehouse' => 1106,
            'dept_name' => 'Treatment Hub',
            'dept_shortname' => "Treatment Hub",
        ]);
        
        Department::create([
            'dept_PK_msc_warehouse' => 1107,
            'dept_name' => 'Milk Bank (Deactivated)',
            'dept_shortname' => "Milk Bank (Deactivated)",
        ]);
        
        Department::create([
            'dept_PK_msc_warehouse' => 1108,
            'dept_name' => 'Nuclear Medicine Department',
            'dept_shortname' => "NONE",
        ]);
        
        Department::create([
            'dept_PK_msc_warehouse' => 1109,
            'dept_name' => 'Planning Department',
            'dept_shortname' => "Planning",
        ]);
        
        Department::create([
            'dept_PK_msc_warehouse' => 1110,
            'dept_name' => 'Finance Department',
            'dept_shortname' => "NONE",
        ]);
        
        Department::create([
            'dept_PK_msc_warehouse' => 1111,
            'dept_name' => 'Pediatric Intensive Care Unit (PICU)',
            'dept_shortname' => "PICU",
        ]);
        
        Department::create([
            'dept_PK_msc_warehouse' => 1112,
            'dept_name' => 'OB-Gyne Department',
            'dept_shortname' => "OB-GYNE Conference",
        ]);
        
        Department::create([
            'dept_PK_msc_warehouse' => 1113,
            'dept_name' => 'OB-GYNE PACU',
            'dept_shortname' => "NONE",
        ]);
        
        Department::create([
            'dept_PK_msc_warehouse' => 1114,
            'dept_name' => 'OPD Chief Office',
            'dept_shortname' => "NONE",
        ]);
        
        Department::create([
            'dept_PK_msc_warehouse' => 1115,
            'dept_name' => 'PHARMACY ARMM',
            'dept_shortname' => "PHARMACY ARMM",
        ]);
        
        Department::create([
            'dept_PK_msc_warehouse' => 1116,
            'dept_name' => 'PHARMACY (Emergency Medicines)',
            'dept_shortname' => "PHARMACY (Emergency Medicines)",
        ]);
        
        Department::create([
            'dept_PK_msc_warehouse' => 1117,
            'dept_name' => 'Cancer Center',
            'dept_shortname' => "Cancer Center",
        ]);
        
        Department::create([
            'dept_PK_msc_warehouse' => 1118,
            'dept_name' => 'Nutrition and Dietetics Warehouse',
            'dept_shortname' => "NONE",
        ]);
        
        Department::create([
            'dept_PK_msc_warehouse' => 1119,
            'dept_name' => 'Eye Center Ward',
            'dept_shortname' => "EYE CENTER WARD",
        ]);
        
        Department::create([
            'dept_PK_msc_warehouse' => 1120,
            'dept_name' => 'Peritonial Dialysis Unit',
            'dept_shortname' => "NONE",
        ]);
        
        Department::create([
            'dept_PK_msc_warehouse' => 1121,
            'dept_name' => 'Endoscopy Unit',
            'dept_shortname' => "NONE",
        ]);
        
        Department::create([
            'dept_PK_msc_warehouse' => 1122,
            'dept_name' => 'Central Supply OPD',
            'dept_shortname' => "CSR",
        ]);
        
        Department::create([
            'dept_PK_msc_warehouse' => 1123,
            'dept_name' => 'Warehouse Medicines (ARMM)',
            'dept_shortname' => "NONE",
        ]);
        
        Department::create([
            'dept_PK_msc_warehouse' => 1124,
            'dept_name' => 'Patient Safety Office',
            'dept_shortname' => "PATIENT SAFETY OFFICE",
        ]);
        
        Department::create([
            'dept_PK_msc_warehouse' => 1125,
            'dept_name' => 'COVID OPD Building',
            'dept_shortname' => "NONE",
        ]);
        
        Department::create([
            'dept_PK_msc_warehouse' => 1126,
            'dept_name' => 'COVID ER - ISO',
            'dept_shortname' => "NONE",
        ]);
        
        Department::create([
            'dept_PK_msc_warehouse' => 1127,
            'dept_name' => 'COVID Surgery Building',
            'dept_shortname' => "NONE",
        ]);
        
        Department::create([
            'dept_PK_msc_warehouse' => 1128,
            'dept_name' => 'COVID Pedia Building',
            'dept_shortname' => "NONE",
        ]);
        
        Department::create([
            'dept_PK_msc_warehouse' => 1129,
            'dept_name' => 'COVID Ward 5 Building',
            'dept_shortname' => "COVID WARD5 BUILDING",
        ]);
        
        Department::create([
            'dept_PK_msc_warehouse' => 1130,
            'dept_name' => 'COVID Ward 9 Building',
            'dept_shortname' => "NONE",
        ]);
        
        Department::create([
            'dept_PK_msc_warehouse' => 1131,
            'dept_name' => 'PPE-RMT',
            'dept_shortname' => "PPE-RMT",
        ]);
        
        Department::create([
            'dept_PK_msc_warehouse' => 1132,
            'dept_name' => 'COVID CIU-Stepdown Cabatangan',
            'dept_shortname' => "NONE",
        ]);
        
        Department::create([
            'dept_PK_msc_warehouse' => 1133,
            'dept_name' => 'COVID Dialysis',
            'dept_shortname' => "NONE",
        ]);
        
        Department::create([
            'dept_PK_msc_warehouse' => 1134,
            'dept_name' => 'WARD 1 HOLDING AREA',
            'dept_shortname' => "NONE",
        ]);
        
        Department::create([
            'dept_PK_msc_warehouse' => 1135,
            'dept_name' => 'Ward 5 Infectious',
            'dept_shortname' => "NONE",
        ]);
        
        Department::create([
            'dept_PK_msc_warehouse' => 1136,
            'dept_name' => 'Ward 4 Infectious',
            'dept_shortname' => "NONE",
        ]);
        
        Department::create([
            'dept_PK_msc_warehouse' => 1137,
            'dept_name' => 'Ward 8 Infectious',
            'dept_shortname' => "NONE",
        ]);
        
        Department::create([
            'dept_PK_msc_warehouse' => 1138,
            'dept_name' => 'Office for Institutional Strategy and Excellence',
            'dept_shortname' => "NONE",
        ]);
        
        Department::create([
            'dept_PK_msc_warehouse' => 1139,
            'dept_name' => 'Medical Oxygen',
            'dept_shortname' => "Medical Oxygen",
        ]);
        
        Department::create([
            'dept_PK_msc_warehouse' => 1140,
            'dept_name' => 'Medical Oxygen Gas Plant',
            'dept_shortname' => "NONE",
        ]);
        
        Department::create([
            'dept_PK_msc_warehouse' => 1140,
            'dept_name' => 'Medical Oxygen Gas Plant',
            'dept_shortname' => "NONE",
        ]);
        
        Department::create([
            'dept_PK_msc_warehouse' => 1141,
            'dept_name' => 'COVID Triage',
            'dept_shortname' => "NONE",
        ]);
        
        Department::create([
            'dept_PK_msc_warehouse' => 1142,
            'dept_name' => 'COVID Pre-Triage',
            'dept_shortname' => "NONE",
        ]);
        
        Department::create([
            'dept_PK_msc_warehouse' => 1143,
            'dept_name' => 'WARD 2 Holding Area',
            'dept_shortname' => "NONE",
        ]);
        
        Department::create([
            'dept_PK_msc_warehouse' => 1144,
            'dept_name' => 'IM Transition Area',
            'dept_shortname' => "NONE",
        ]);
        
        Department::create([
            'dept_PK_msc_warehouse' => 1145,
            'dept_name' => 'PPE-RMT WAREHOUSE',
            'dept_shortname' => "NONE",
        ]);
        
        Department::create([
            'dept_PK_msc_warehouse' => 1146,
            'dept_name' => 'PoIson Control Center',
            'dept_shortname' => "PCC",
        ]);
        
        Department::create([
            'dept_PK_msc_warehouse' => 1147,
            'dept_name' => 'Integrated Hospital Operations Management Program',
            'dept_shortname' => "IHOMP",
        ]);
        
        Department::create([
            'dept_PK_msc_warehouse' => 1148,
            'dept_name' => 'Cashier Collecting',
            'dept_shortname' => "NONE",
        ]);
        
        Department::create([
            'dept_PK_msc_warehouse' => 1149,
            'dept_name' => 'DOH Warehouse',
            'dept_shortname' => "NONE",
        ]);
        
        Department::create([
            'dept_PK_msc_warehouse' => 1150,
            'dept_name' => 'CSSD/MEDICINE DISPOSAL',
            'dept_shortname' => "NONE",
        ]);
        
        Department::create([
            'dept_PK_msc_warehouse' => 1151,
            'dept_name' => 'Pediatrics Department',
            'dept_shortname' => "NONE",
        ]);
        
        Department::create([
            'dept_PK_msc_warehouse' => 1152,
            'dept_name' => 'Gyne Oncology',
            'dept_shortname' => "NONE",
        ]);
        
        Department::create([
            'dept_PK_msc_warehouse' => 1153,
            'dept_name' => 'Chemotherapy Unit',
            'dept_shortname' => "Chemo Unit",
        ]);
        
        Department::create([
            'dept_PK_msc_warehouse' => 1154,
            'dept_name' => 'HOSPITAL PATIENT SAFETY COMMITTEE',
            'dept_shortname' => "NONE",
        ]);
        
        Department::create([
            'dept_PK_msc_warehouse' => 1155,
            'dept_name' => 'EYE CENTER PACU',
            'dept_shortname' => "NONE",
        ]);
        
        Department::create([
            'dept_PK_msc_warehouse' => 1156,
            'dept_name' => 'CLAIMS MEDICAL UNIT',
            'dept_shortname' => "NONE",
        ]);
        
        Department::create([
            'dept_PK_msc_warehouse' => 1157,
            'dept_name' => 'RADIOLOGY DEPARMENT',
            'dept_shortname' => "NONE",
        ]);
        
        Department::create([
            'dept_PK_msc_warehouse' => 1158,
            'dept_name' => 'ISOLATION BUILDING',
            'dept_shortname' => "NONE",
        ]);
        
        Department::create([
            'dept_PK_msc_warehouse' => 1159,
            'dept_name' => 'Committee on ARTA',
            'dept_shortname' => "NONE",
        ]);
        
        Department::create([
            'dept_PK_msc_warehouse' => 1160,
            'dept_name' => 'DONATIONS',
            'dept_shortname' => "NONE",
        ]);
    }
}
