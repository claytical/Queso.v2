<?php

namespace App\Services\Macros;
use App\Content;
use DB;
use App\Course;
use App\Team;
use App\Models\Access\Role\Role;
use App\GroupQuest;
use App\Quest;
/**
 * Class Dropdowns
 * @package App\Services\Macros
 */
trait Dropdowns
{
    /**
     * Use this to set the default country state type for the shorthand method
     * @param  $name
     * @param  null     $selected
     * @param  array    $options
     * @return string
     */

    public function submission_count() {
        $course = Course::find(session('current_course'));
        $quests = $course->quests()->where('groups', '=', false)->get();
        $group_quests = $course->quests()->where('groups', '=', true)->get();
        $submission_count = 0;
        foreach($quests as $quest) {
            $submission_count += $quest->users()->where('graded', false)->count();
        }
        foreach($group_quests as $quest) {
            $submission_count += GroupQuest::where('quest_id', '=', $quest->id)
                                    ->where('graded', '=', false)
                                    ->count();
        }
        if($submission_count == 0) {
            return "";
        }
        return $submission_count;
    }


    public function singleResourceList() {
        
        $resources = Content::where('course_id', '=', session('current_course'))
                                ->whereNull('tag')
                                ->get();
        $html = "";
        foreach($resources as $resource) {
            //" . Active::pattern('resource/' . $resource->id) . "
            $html = $html . "<li class=''><a href='".url('resource/'.$resource->id)."'>".$resource->title."</a></li>";
        }
        
        return $html;
    }

    public function courseList() {
        $user = access()->user();
        $courses = $user->courses();
        return $user->courses()->lists('name', 'id');
    }

    public function courses() {
        $user = access()->user();
        $courses = $user->courses();
        $teaching = array();
        $not_teaching = array();

        foreach($courses as $course) {
            if(access()->hasRole($course->instructor_role_id)) {
                //Instructor
                $teaching[] = $course;                
            }
            else {
                //Student
                $not_teaching[] = $course;
            }


        }


        return ["teaching" => $teaching, "not_teaching" => $not_teaching];

    }

    public function teamEmailList($id) {
        $team = Team::find($id);
        $students = $team->users;
        return $students->implode('email', ',');  
    }

    public function courseEmailList($course_id) {
        $course = Course::find($course_id);
        $students = $course->users()
                    ->where('users.id', '!=', access()->user()->id)
                    ->get();
        return $students->implode(('email'), ',');
    }

    public function remainingStudentList($name, $quest_id, $selected = null, $options = array()) {
        $user = access()->user();
        $quest_ids = GroupQuest::where('quest_id', '=', $quest_id)->pluck('id');
        $quest = Quest::find($quest_id);
        $course = Course::find($quest->course_id);
        $group = DB::table('group_quest_users')
                        ->select('user_id')
                        ->whereIn('group_quest_id', $quest_ids)
                        ->pluck('user_id');
        $students = Role::find($course->student_role_id)
                            ->users()
                            ->where('users.id', '!=', $user->id)
                            ->whereNotIn('users.id', $group)
                            ->lists('users.name', 'users.id');

        return $this->select($name, $students, $selected, $options);

    }
    public function studentList($name, $selected = null, $options = array()) {
        $user = access()->user();
        $course = Course::find(session('current_course'));
        $students = Role::find($course->student_role_id)
                            ->users()
                            ->where('users.id', '!=', $user->id)
                            ->lists('users.name', 'users.id');

        return $this->select($name, $students, $selected, $options);

    }

    public function categoryResourceList() {

        $resource_categories = DB::table('contents')
                                ->select( DB::raw('DISTINCT(tag) as tag') )
                                ->where('course_id', '=', session('current_course'))
                                ->whereNotNull('tag')
                                ->groupBy('tag')
                                ->get();


        $html = "";
        foreach($resource_categories as $category) {

            $tag = str_replace(" ", "-", $category->tag);
            $html = $html . "<li class=''><a href='" . url('resource/category/'.$tag)."'>".$tag."</a></li>";
        }
        return $html;

    }

    public function selectState($name, $selected = null, $options = array())
    {
        return $this->selectStateUS($name, $selected, $options);
    }

    /**
     * @param  $name
     * @param  null     $selected
     * @param  array    $options
     * @return string
     */
    public function selectStateUS($name, $selected = null, $options = array())
    {
        $list = [
            ''   => 'Select One...',
            'AL' => 'Alabama',
            'AK' => 'Alaska',
            'AZ' => 'Arizona',
            'AR' => 'Arkansas',
            'CA' => 'California',
            'CO' => 'Colorado',
            'CT' => 'Connecticut',
            'DE' => 'Delaware',
            'DC' => 'District of Columbia',
            'FL' => 'Florida',
            'GA' => 'Georgia',
            'HI' => 'Hawaii',
            'ID' => 'Idaho',
            'IL' => 'Illinois',
            'IN' => 'Indiana',
            'IA' => 'Iowa',
            'KS' => 'Kansas',
            'KY' => 'Kentucky',
            'LA' => 'Louisiana',
            'ME' => 'Maine',
            'MD' => 'Maryland',
            'MA' => 'Massachusetts',
            'MI' => 'Michigan',
            'MN' => 'Minnesota',
            'MS' => 'Mississippi',
            'MO' => 'Missouri',
            'MT' => 'Montana',
            'NE' => 'Nebraska',
            'NV' => 'Nevada',
            'NH' => 'New Hampshire',
            'NJ' => 'New Jersey',
            'NM' => 'New Mexico',
            'NY' => 'New York',
            'NC' => 'North Carolina',
            'ND' => 'North Dakota',
            'OH' => 'Ohio',
            'OK' => 'Oklahoma',
            'OR' => 'Oregon',
            'PA' => 'Pennsylvania',
            'RI' => 'Rhode Island',
            'SC' => 'South Carolina',
            'SD' => 'South Dakota',
            'TN' => 'Tennessee',
            'TX' => 'Texas',
            'UT' => 'Utah',
            'VT' => 'Vermont',
            'VA' => 'Virginia',
            'WA' => 'Washington',
            'WV' => 'West Virginia',
            'WI' => 'Wisconsin',
            'WY' => 'Wyoming',
        ];

        return $this->select($name, $list, $selected, $options);
    }

    /**
     * @param  $name
     * @param  null    $selected
     * @param  array   $options
     * @return mixed
     */
    public function selectStateUSOutlyingTerritories($name, $selected = null, $options = array())
    {
        $list = [
            ''   => 'Select One...',
            'AS' => 'American Samoa',
            'GU' => 'Guam',
            'MP' => 'Northern Mariana Islands',
            'PR' => 'Puerto Rico',
            'UM' => 'United States Minor Outlying Islands',
            'VI' => 'Virgin Islands',
        ];

        return $this->select($name, $list, $selected, $options);
    }

    /**
     * @param  $name
     * @param  null    $selected
     * @param  array   $options
     * @return mixed
     */
    public function selectStateUSArmedForces($name, $selected = null, $options = array())
    {
        $list = [
            ''   => 'Select One...',
            'AA' => 'Armed Forces Americas',
            'AP' => 'Armed Forces Pacific',
            'AE' => 'Armed Forces Others',
        ];

        return $this->select($name, $list, $selected, $options);
    }

    /**
     * @param  $name
     * @param  null    $selected
     * @param  array   $options
     * @return mixed
     */
    public function selectCanadaTerritories($name, $selected = null, $options = array())
    {
        $list = [
            ''   => 'Select One...',
            'AB' => 'Alberta',
            'BC' => 'British Columbia',
            'MB' => 'Manitoba',
            'NB' => 'New Brunswick',
            'NL' => 'Newfoundland and Labrador',
            'NS' => 'Nova Scotia',
            'ON' => 'Ontario',
            'PE' => 'Prince Edward Island',
            'QC' => 'Quebec',
            'SK' => 'Saskatchewan',
            'NT' => 'Northwest Territories',
            'NU' => 'Nunavut',
            'YT' => 'Yukon',
        ];

        return $this->select($name, $list, $selected, $options);
    }

    /**
     * @param  $name
     * @param  null    $selected
     * @param  array   $options
     * @return mixed
     */
    public function selectStateMexico($name, $selected = null, $options = array())
    {
        $list = [
            ''    => 'Select One...',
            'DIF' => 'Distrito Federal',
            'AGS' => 'Aguascalientes',
            'BCN' => 'Baja California',
            'BCS' => 'Baja California Sur',
            'CAM' => 'Campeche',
            'CHP' => 'Chiapas',
            'CHI' => 'Chihuahua',
            'COA' => 'Coahuila',
            'COL' => 'Colima',
            'DUR' => 'Durango',
            'GTO' => 'Guanajuato',
            'GRO' => 'Guerrero',
            'HGO' => 'Hidalgo',
            'JAL' => 'Jalisco',
            'MEX' => 'Mexico',
            'MIC' => 'Michoacan',
            'MOR' => 'Morelos',
            'NAY' => 'Nayarit',
            'NLE' => 'Nuevo Le&oacute;n',
            'OAX' => 'Oaxaca',
            'PUE' => 'Puebla',
            'QRO' => 'Queretaro',
            'ROO' => 'Quintana Roo',
            'SLP' => 'San Luis Potos&iacute;',
            'SIN' => 'Sinaloa',
            'SON' => 'Sonora',
            'TAB' => 'Tabasco',
            'TAM' => 'Tamaulipas',
            'TLX' => 'Tlaxcala',
            'VER' => 'Veracruz',
            'YUC' => 'Yucatan',
            'ZAC' => 'Zacatecas',
        ];

        return $this->select($name, $list, $selected, $options);
    }

    /**
     * Use this to set the default country dropdown type for the shorthand method
     * @param  $name
     * @param  null     $selected
     * @param  array    $options
     * @return string
     */
    public function selectCountry($name, $selected = null, $options = array())
    {
        return $this->selectCountryAlpha2($name, $selected, $options);
    }

    /**
     * @param  $name
     * @param  null    $selected
     * @param  array   $options
     * @return mixed
     */
    public function selectCountryAlpha($name, $selected = null, $options = array())
    {
        $list = [
            ''              => 'Select One...',
            'ISO 3166-2:AF' => 'Afghanistan',
            'ISO 3166-2:AX' => 'Åland Islands',
            'ISO 3166-2:AL' => 'Albania',
            'ISO 3166-2:DZ' => 'Algeria',
            'ISO 3166-2:AS' => 'American Samoa',
            'ISO 3166-2:AD' => 'Andorra',
            'ISO 3166-2:AO' => 'Angola',
            'ISO 3166-2:AI' => 'Anguilla',
            'ISO 3166-2:AQ' => 'Antarctica',
            'ISO 3166-2:AG' => 'Antigua and Barbuda',
            'ISO 3166-2:AR' => 'Argentina',
            'ISO 3166-2:AM' => 'Armenia',
            'ISO 3166-2:AW' => 'Aruba',
            'ISO 3166-2:AU' => 'Australia',
            'ISO 3166-2:AT' => 'Austria',
            'ISO 3166-2:AZ' => 'Azerbaijan',
            'ISO 3166-2:BS' => 'Bahamas',
            'ISO 3166-2:BH' => 'Bahrain',
            'ISO 3166-2:BD' => 'Bangladesh',
            'ISO 3166-2:BB' => 'Barbados',
            'ISO 3166-2:BY' => 'Belarus',
            'ISO 3166-2:BE' => 'Belgium',
            'ISO 3166-2:BZ' => 'Belize',
            'ISO 3166-2:BJ' => 'Benin',
            'ISO 3166-2:BM' => 'Bermuda',
            'ISO 3166-2:BT' => 'Bhutan',
            'ISO 3166-2:BO' => 'Bolivia, Plurinational State of',
            'ISO 3166-2:BQ' => 'Bonaire, Sint Eustatius and Saba',
            'ISO 3166-2:BA' => 'Bosnia and Herzegovina',
            'ISO 3166-2:BW' => 'Botswana',
            'ISO 3166-2:BV' => 'Bouvet Island',
            'ISO 3166-2:BR' => 'Brazil',
            'ISO 3166-2:IO' => 'British Indian Ocean Territory',
            'ISO 3166-2:BN' => 'Brunei Darussalam',
            'ISO 3166-2:BG' => 'Bulgaria',
            'ISO 3166-2:BF' => 'Burkina Faso',
            'ISO 3166-2:BI' => 'Burundi',
            'ISO 3166-2:KH' => 'Cambodia',
            'ISO 3166-2:CM' => 'Cameroon',
            'ISO 3166-2:CA' => 'Canada',
            'ISO 3166-2:CV' => 'Cape Verde',
            'ISO 3166-2:KY' => 'Cayman Islands',
            'ISO 3166-2:CF' => 'Central African Republic',
            'ISO 3166-2:TD' => 'Chad',
            'ISO 3166-2:CL' => 'Chile',
            'ISO 3166-2:CN' => 'China',
            'ISO 3166-2:CX' => 'Christmas Island',
            'ISO 3166-2:CC' => 'Cocos (Keeling) Islands',
            'ISO 3166-2:CO' => 'Colombia',
            'ISO 3166-2:KM' => 'Comoros',
            'ISO 3166-2:CG' => 'Congo',
            'ISO 3166-2:CD' => 'Congo, the Democratic Republic of the',
            'ISO 3166-2:CK' => 'Cook Islands',
            'ISO 3166-2:CR' => 'Costa Rica',
            'ISO 3166-2:CI' => 'Côte d\Ivoire',
            'ISO 3166-2:HR' => 'Croatia',
            'ISO 3166-2:CU' => 'Cuba',
            'ISO 3166-2:CW' => 'Curaçao',
            'ISO 3166-2:CY' => 'Cyprus',
            'ISO 3166-2:CZ' => 'Czech Republic',
            'ISO 3166-2:DK' => 'Denmark',
            'ISO 3166-2:DJ' => 'Djibouti',
            'ISO 3166-2:DM' => 'Dominica',
            'ISO 3166-2:DO' => 'Dominican Republic',
            'ISO 3166-2:EC' => 'Ecuador',
            'ISO 3166-2:EG' => 'Egypt',
            'ISO 3166-2:SV' => 'El Salvador',
            'ISO 3166-2:GQ' => 'Equatorial Guinea',
            'ISO 3166-2:ER' => 'Eritrea',
            'ISO 3166-2:EE' => 'Estonia',
            'ISO 3166-2:ET' => 'Ethiopia',
            'ISO 3166-2:FK' => 'Falkland Islands (Malvinas)',
            'ISO 3166-2:FO' => 'Faroe Islands',
            'ISO 3166-2:FJ' => 'Fiji',
            'ISO 3166-2:FI' => 'Finland',
            'ISO 3166-2:FR' => 'France',
            'ISO 3166-2:GF' => 'French Guiana',
            'ISO 3166-2:PF' => 'French Polynesia',
            'ISO 3166-2:TF' => 'French Southern Territories',
            'ISO 3166-2:GA' => 'Gabon',
            'ISO 3166-2:GM' => 'Gambia',
            'ISO 3166-2:GE' => 'Georgia',
            'ISO 3166-2:DE' => 'Germany',
            'ISO 3166-2:GH' => 'Ghana',
            'ISO 3166-2:GI' => 'Gibraltar',
            'ISO 3166-2:GR' => 'Greece',
            'ISO 3166-2:GL' => 'Greenland',
            'ISO 3166-2:GD' => 'Grenada',
            'ISO 3166-2:GP' => 'Guadeloupe',
            'ISO 3166-2:GU' => 'Guam',
            'ISO 3166-2:GT' => 'Guatemala',
            'ISO 3166-2:GG' => 'Guernsey',
            'ISO 3166-2:GN' => 'Guinea',
            'ISO 3166-2:GW' => 'Guinea-Bissau',
            'ISO 3166-2:GY' => 'Guyana',
            'ISO 3166-2:HT' => 'Haiti',
            'ISO 3166-2:HM' => 'Heard Island and McDonald Islands',
            'ISO 3166-2:VA' => 'Holy See (Vatican City State)',
            'ISO 3166-2:HN' => 'Honduras',
            'ISO 3166-2:HK' => 'Hong Kong',
            'ISO 3166-2:HU' => 'Hungary',
            'ISO 3166-2:IS' => 'Iceland',
            'ISO 3166-2:IN' => 'India',
            'ISO 3166-2:ID' => 'Indonesia',
            'ISO 3166-2:IR' => 'Iran, Islamic Republic of',
            'ISO 3166-2:IQ' => 'Iraq',
            'ISO 3166-2:IE' => 'Ireland',
            'ISO 3166-2:IM' => 'Isle of Man',
            'ISO 3166-2:IL' => 'Israel',
            'ISO 3166-2:IT' => 'Italy',
            'ISO 3166-2:JM' => 'Jamaica',
            'ISO 3166-2:JP' => 'Japan',
            'ISO 3166-2:JE' => 'Jersey',
            'ISO 3166-2:JO' => 'Jordan',
            'ISO 3166-2:KZ' => 'Kazakhstan',
            'ISO 3166-2:KE' => 'Kenya',
            'ISO 3166-2:KI' => 'Kiribati',
            'ISO 3166-2:KP' => 'Korea, Democratic People\'s Republic of',
            'ISO 3166-2:KR' => 'Korea, Republic of',
            'ISO 3166-2:KW' => 'Kuwait',
            'ISO 3166-2:KG' => 'Kyrgyzstan',
            'ISO 3166-2:LA' => 'Lao People\'s Democratic Republic',
            'ISO 3166-2:LV' => 'Latvia',
            'ISO 3166-2:LB' => 'Lebanon',
            'ISO 3166-2:LS' => 'Lesotho',
            'ISO 3166-2:LR' => 'Liberia',
            'ISO 3166-2:LY' => 'Libya',
            'ISO 3166-2:LI' => 'Liechtenstein',
            'ISO 3166-2:LT' => 'Lithuania',
            'ISO 3166-2:LU' => 'Luxembourg',
            'ISO 3166-2:MO' => 'Macao',
            'ISO 3166-2:MK' => 'Macedonia, the former Yugoslav Republic of',
            'ISO 3166-2:MG' => 'Madagascar',
            'ISO 3166-2:MW' => 'Malawi',
            'ISO 3166-2:MY' => 'Malaysia',
            'ISO 3166-2:MV' => 'Maldives',
            'ISO 3166-2:ML' => 'Mali',
            'ISO 3166-2:MT' => 'Malta',
            'ISO 3166-2:MH' => 'Marshall Islands',
            'ISO 3166-2:MQ' => 'Martinique',
            'ISO 3166-2:MR' => 'Mauritania',
            'ISO 3166-2:MU' => 'Mauritius',
            'ISO 3166-2:YT' => 'Mayotte',
            'ISO 3166-2:MX' => 'Mexico',
            'ISO 3166-2:FM' => 'Micronesia, Federated States of',
            'ISO 3166-2:MD' => 'Moldova, Republic of',
            'ISO 3166-2:MC' => 'Monaco',
            'ISO 3166-2:MN' => 'Mongolia',
            'ISO 3166-2:ME' => 'Montenegro',
            'ISO 3166-2:MS' => 'Montserrat',
            'ISO 3166-2:MA' => 'Morocco',
            'ISO 3166-2:MZ' => 'Mozambique',
            'ISO 3166-2:MM' => 'Myanmar',
            'ISO 3166-2:NA' => 'Namibia',
            'ISO 3166-2:NR' => 'Nauru',
            'ISO 3166-2:NP' => 'Nepal',
            'ISO 3166-2:NL' => 'Netherlands',
            'ISO 3166-2:NC' => 'New Caledonia',
            'ISO 3166-2:NZ' => 'New Zealand',
            'ISO 3166-2:NI' => 'Nicaragua',
            'ISO 3166-2:NE' => 'Niger',
            'ISO 3166-2:NG' => 'Nigeria',
            'ISO 3166-2:NU' => 'Niue',
            'ISO 3166-2:NF' => 'Norfolk Island',
            'ISO 3166-2:MP' => 'Northern Mariana Islands',
            'ISO 3166-2:NO' => 'Norway',
            'ISO 3166-2:OM' => 'Oman',
            'ISO 3166-2:PK' => 'Pakistan',
            'ISO 3166-2:PW' => 'Palau',
            'ISO 3166-2:PS' => 'Palestinian Territory, Occupied',
            'ISO 3166-2:PA' => 'Panama',
            'ISO 3166-2:PG' => 'Papua New Guinea',
            'ISO 3166-2:PY' => 'Paraguay',
            'ISO 3166-2:PE' => 'Peru',
            'ISO 3166-2:PH' => 'Philippines',
            'ISO 3166-2:PN' => 'Pitcairn',
            'ISO 3166-2:PL' => 'Poland',
            'ISO 3166-2:PT' => 'Portugal',
            'ISO 3166-2:PR' => 'Puerto Rico',
            'ISO 3166-2:QA' => 'Qatar',
            'ISO 3166-2:RE' => 'Réunion',
            'ISO 3166-2:RO' => 'Romania',
            'ISO 3166-2:RU' => 'Russian Federation',
            'ISO 3166-2:RW' => 'Rwanda',
            'ISO 3166-2:BL' => 'Saint Barthélemy',
            'ISO 3166-2:SH' => 'Saint Helena, Ascension and Tristan da Cunha',
            'ISO 3166-2:KN' => 'Saint Kitts and Nevis',
            'ISO 3166-2:LC' => 'Saint Lucia',
            'ISO 3166-2:MF' => 'Saint Martin (French part)',
            'ISO 3166-2:PM' => 'Saint Pierre and Miquelon',
            'ISO 3166-2:VC' => 'Saint Vincent and the Grenadines',
            'ISO 3166-2:WS' => 'Samoa',
            'ISO 3166-2:SM' => 'San Marino',
            'ISO 3166-2:ST' => 'Sao Tome and Principe',
            'ISO 3166-2:SA' => 'Saudi Arabia',
            'ISO 3166-2:SN' => 'Senegal',
            'ISO 3166-2:RS' => 'Serbia',
            'ISO 3166-2:SC' => 'Seychelles',
            'ISO 3166-2:SL' => 'Sierra Leone',
            'ISO 3166-2:SG' => 'Singapore',
            'ISO 3166-2:SX' => 'Sint Maarten (Dutch part)',
            'ISO 3166-2:SK' => 'Slovakia',
            'ISO 3166-2:SI' => 'Slovenia',
            'ISO 3166-2:SB' => 'Solomon Islands',
            'ISO 3166-2:SO' => 'Somalia',
            'ISO 3166-2:ZA' => 'South Africa',
            'ISO 3166-2:GS' => 'South Georgia and the South Sandwich Islands',
            'ISO 3166-2:SS' => 'South Sudan',
            'ISO 3166-2:ES' => 'Spain',
            'ISO 3166-2:LK' => 'Sri Lanka',
            'ISO 3166-2:SD' => 'Sudan',
            'ISO 3166-2:SR' => 'Suriname',
            'ISO 3166-2:SJ' => 'Svalbard and Jan Mayen',
            'ISO 3166-2:SZ' => 'Swaziland',
            'ISO 3166-2:SE' => 'Sweden',
            'ISO 3166-2:CH' => 'Switzerland',
            'ISO 3166-2:SY' => 'Syrian Arab Republic',
            'ISO 3166-2:TW' => 'Taiwan, Province of China',
            'ISO 3166-2:TJ' => 'Tajikistan',
            'ISO 3166-2:TZ' => 'Tanzania, United Republic of',
            'ISO 3166-2:TH' => 'Thailand',
            'ISO 3166-2:TL' => 'Timor-Leste',
            'ISO 3166-2:TG' => 'Togo',
            'ISO 3166-2:TK' => 'Tokelau',
            'ISO 3166-2:TO' => 'Tonga',
            'ISO 3166-2:TT' => 'Trinidad and Tobago',
            'ISO 3166-2:TN' => 'Tunisia',
            'ISO 3166-2:TR' => 'Turkey',
            'ISO 3166-2:TM' => 'Turkmenistan',
            'ISO 3166-2:TC' => 'Turks and Caicos Islands',
            'ISO 3166-2:TV' => 'Tuvalu',
            'ISO 3166-2:UG' => 'Uganda',
            'ISO 3166-2:UA' => 'Ukraine',
            'ISO 3166-2:AE' => 'United Arab Emirates',
            'ISO 3166-2:GB' => 'United Kingdom',
            'ISO 3166-2:US' => 'United States',
            'ISO 3166-2:UM' => 'United States Minor Outlying Islands',
            'ISO 3166-2:UY' => 'Uruguay',
            'ISO 3166-2:UZ' => 'Uzbekistan',
            'ISO 3166-2:VU' => 'Vanuatu',
            'ISO 3166-2:VE' => 'Venezuela, Bolivarian Republic of',
            'ISO 3166-2:VN' => 'Viet Nam',
            'ISO 3166-2:VG' => 'Virgin Islands, British',
            'ISO 3166-2:VI' => 'Virgin Islands, U.S.',
            'ISO 3166-2:WF' => 'Wallis and Futuna',
            'ISO 3166-2:EH' => 'Western Sahara',
            'ISO 3166-2:YE' => 'Yemen',
            'ISO 3166-2:ZM' => 'Zambia',
            'ISO 3166-2:ZW' => 'Zimbabwe',
        ];

        return $this->select($name, $list, $selected, $options);
    }

    /**
     * @param  $name
     * @param  null     $selected
     * @param  array    $options
     * @return string
     */
    public function selectCountryAlpha2($name, $selected = null, $options = array())
    {
        $list = [
            ''   => 'Select One...',
            'AF' => 'Afghanistan',
            'AX' => 'Aland Islands',
            'AL' => 'Albania',
            'DZ' => 'Algeria',
            'AS' => 'American Samoa',
            'AD' => 'Andorra',
            'AO' => 'Angola',
            'AI' => 'Anguilla',
            'AQ' => 'Antarctica',
            'AG' => 'Antigua and Barbuda',
            'AR' => 'Argentina',
            'AM' => 'Armenia',
            'AW' => 'Aruba',
            'AU' => 'Australia',
            'AT' => 'Austria',
            'AZ' => 'Azerbaijan',
            'BS' => 'Bahamas',
            'BH' => 'Bahrain',
            'BD' => 'Bangladesh',
            'BB' => 'Barbados',
            'BY' => 'Belarus',
            'BE' => 'Belgium',
            'BZ' => 'Belize',
            'BJ' => 'Benin',
            'BM' => 'Bermuda',
            'BT' => 'Bhutan',
            'BO' => 'Bolivia',
            'BA' => 'Bosnia and Herzegovina',
            'BW' => 'Botswana',
            'BV' => 'Bouvet Island',
            'BR' => 'Brazil',
            'IO' => 'British Indian Ocean Territory',
            'BN' => 'Brunei Darussalam',
            'BG' => 'Bulgaria',
            'BF' => 'Burkina Faso',
            'BI' => 'Burundi',
            'KH' => 'Cambodia',
            'CM' => 'Cameroon',
            'CA' => 'Canada',
            'CV' => 'Cape Verde',
            'KY' => 'Cayman Islands',
            'CF' => 'Central African Republic',
            'TD' => 'Chad',
            'CL' => 'Chile',
            'CN' => 'China',
            'CX' => 'Christmas Island',
            'CC' => 'Cocos (Keeling) Islands',
            'CO' => 'Colombia',
            'KM' => 'Comoros',
            'CG' => 'Congo',
            'CD' => 'Congo, The Democratic Republic of The',
            'CK' => 'Cook Islands',
            'CR' => 'Costa Rica',
            'CI' => 'Cote D\'ivoire',
            'HR' => 'Croatia',
            'CU' => 'Cuba',
            'CY' => 'Cyprus',
            'CZ' => 'Czech Republic',
            'DK' => 'Denmark',
            'DJ' => 'Djibouti',
            'DM' => 'Dominica',
            'DO' => 'Dominican Republic',
            'EC' => 'Ecuador',
            'EG' => 'Egypt',
            'SV' => 'El Salvador',
            'GQ' => 'Equatorial Guinea',
            'ER' => 'Eritrea',
            'EE' => 'Estonia',
            'ET' => 'Ethiopia',
            'FK' => 'Falkland Islands (Malvinas)',
            'FO' => 'Faroe Islands',
            'FJ' => 'Fiji',
            'FI' => 'Finland',
            'FR' => 'France',
            'GF' => 'French Guiana',
            'PF' => 'French Polynesia',
            'TF' => 'French Southern Territories',
            'GA' => 'Gabon',
            'GM' => 'Gambia',
            'GE' => 'Georgia',
            'DE' => 'Germany',
            'GH' => 'Ghana',
            'GI' => 'Gibraltar',
            'GR' => 'Greece',
            'GL' => 'Greenland',
            'GD' => 'Grenada',
            'GP' => 'Guadeloupe',
            'GU' => 'Guam',
            'GT' => 'Guatemala',
            'GG' => 'Guernsey',
            'GN' => 'Guinea',
            'GW' => 'Guinea-bissau',
            'GY' => 'Guyana',
            'HT' => 'Haiti',
            'HM' => 'Heard Island and Mcdonald Islands',
            'VA' => 'Holy See (Vatican City State)',
            'HN' => 'Honduras',
            'HK' => 'Hong Kong',
            'HU' => 'Hungary',
            'IS' => 'Iceland',
            'IN' => 'India',
            'ID' => 'Indonesia',
            'IR' => 'Iran, Islamic Republic of',
            'IQ' => 'Iraq',
            'IE' => 'Ireland',
            'IM' => 'Isle of Man',
            'IL' => 'Israel',
            'IT' => 'Italy',
            'JM' => 'Jamaica',
            'JP' => 'Japan',
            'JE' => 'Jersey',
            'JO' => 'Jordan',
            'KZ' => 'Kazakhstan',
            'KE' => 'Kenya',
            'KI' => 'Kiribati',
            'KP' => 'Korea, Democratic People\'s Republic of',
            'KR' => 'Korea, Republic of',
            'KW' => 'Kuwait',
            'KG' => 'Kyrgyzstan',
            'LA' => 'Lao People\'s Democratic Republic',
            'LV' => 'Latvia',
            'LB' => 'Lebanon',
            'LS' => 'Lesotho',
            'LR' => 'Liberia',
            'LY' => 'Libyan Arab Jamahiriya',
            'LI' => 'Liechtenstein',
            'LT' => 'Lithuania',
            'LU' => 'Luxembourg',
            'MO' => 'Macao',
            'MK' => 'Macedonia, The Former Yugoslav Republic of',
            'MG' => 'Madagascar',
            'MW' => 'Malawi',
            'MY' => 'Malaysia',
            'MV' => 'Maldives',
            'ML' => 'Mali',
            'MT' => 'Malta',
            'MH' => 'Marshall Islands',
            'MQ' => 'Martinique',
            'MR' => 'Mauritania',
            'MU' => 'Mauritius',
            'YT' => 'Mayotte',
            'MX' => 'Mexico',
            'FM' => 'Micronesia, Federated States of',
            'MD' => 'Moldova, Republic of',
            'MC' => 'Monaco',
            'MN' => 'Mongolia',
            'ME' => 'Montenegro',
            'MS' => 'Montserrat',
            'MA' => 'Morocco',
            'MZ' => 'Mozambique',
            'MM' => 'Myanmar',
            'NA' => 'Namibia',
            'NR' => 'Nauru',
            'NP' => 'Nepal',
            'NL' => 'Netherlands',
            'AN' => 'Netherlands Antilles',
            'NC' => 'New Caledonia',
            'NZ' => 'New Zealand',
            'NI' => 'Nicaragua',
            'NE' => 'Niger',
            'NG' => 'Nigeria',
            'NU' => 'Niue',
            'NF' => 'Norfolk Island',
            'MP' => 'Northern Mariana Islands',
            'NO' => 'Norway',
            'OM' => 'Oman',
            'PK' => 'Pakistan',
            'PW' => 'Palau',
            'PS' => 'Palestinian Territory, Occupied',
            'PA' => 'Panama',
            'PG' => 'Papua New Guinea',
            'PY' => 'Paraguay',
            'PE' => 'Peru',
            'PH' => 'Philippines',
            'PN' => 'Pitcairn',
            'PL' => 'Poland',
            'PT' => 'Portugal',
            'PR' => 'Puerto Rico',
            'QA' => 'Qatar',
            'RE' => 'Reunion',
            'RO' => 'Romania',
            'RU' => 'Russian Federation',
            'RW' => 'Rwanda',
            'SH' => 'Saint Helena',
            'KN' => 'Saint Kitts and Nevis',
            'LC' => 'Saint Lucia',
            'PM' => 'Saint Pierre and Miquelon',
            'VC' => 'Saint Vincent and The Grenadines',
            'WS' => 'Samoa',
            'SM' => 'San Marino',
            'ST' => 'Sao Tome and Principe',
            'SA' => 'Saudi Arabia',
            'SN' => 'Senegal',
            'RS' => 'Serbia',
            'SC' => 'Seychelles',
            'SL' => 'Sierra Leone',
            'SG' => 'Singapore',
            'SK' => 'Slovakia',
            'SI' => 'Slovenia',
            'SB' => 'Solomon Islands',
            'SO' => 'Somalia',
            'ZA' => 'South Africa',
            'GS' => 'South Georgia and The South Sandwich Islands',
            'ES' => 'Spain',
            'LK' => 'Sri Lanka',
            'SD' => 'Sudan',
            'SR' => 'Suriname',
            'SJ' => 'Svalbard and Jan Mayen',
            'SZ' => 'Swaziland',
            'SE' => 'Sweden',
            'CH' => 'Switzerland',
            'SY' => 'Syrian Arab Republic',
            'TW' => 'Taiwan, Province of China',
            'TJ' => 'Tajikistan',
            'TZ' => 'Tanzania, United Republic of',
            'TH' => 'Thailand',
            'TL' => 'Timor-leste',
            'TG' => 'Togo',
            'TK' => 'Tokelau',
            'TO' => 'Tonga',
            'TT' => 'Trinidad and Tobago',
            'TN' => 'Tunisia',
            'TR' => 'Turkey',
            'TM' => 'Turkmenistan',
            'TC' => 'Turks and Caicos Islands',
            'TV' => 'Tuvalu',
            'UG' => 'Uganda',
            'UA' => 'Ukraine',
            'AE' => 'United Arab Emirates',
            'GB' => 'United Kingdom',
            'US' => 'United States',
            'UM' => 'United States Minor Outlying Islands',
            'UY' => 'Uruguay',
            'UZ' => 'Uzbekistan',
            'VU' => 'Vanuatu',
            'VE' => 'Venezuela',
            'VN' => 'Viet Nam',
            'VG' => 'Virgin Islands, British',
            'VI' => 'Virgin Islands, U.S.',
            'WF' => 'Wallis and Futuna',
            'EH' => 'Western Sahara',
            'YE' => 'Yemen',
            'ZM' => 'Zambia',
            'ZW' => 'Zimbabwe',
        ];

        return $this->select($name, $list, $selected, $options);
    }

    /**
     * @param  $name
     * @param  null     $selected
     * @param  array    $options
     * @return string
     */
    public function selectCountryAlpha3($name, $selected = null, $options = array())
    {
        $list = [
            ''    => 'Select One...',
            'AFG' => 'Afghanistan',
            'ALA' => 'Åland Islands',
            'ALB' => 'Albania',
            'DZA' => 'Algeria',
            'ASM' => 'American Samoa',
            'AND' => 'Andorra',
            'AGO' => 'Angola',
            'AIA' => 'Anguilla',
            'ATA' => 'Antarctica',
            'ATG' => 'Antigua and Barbuda',
            'ARG' => 'Argentina',
            'ARM' => 'Armenia',
            'ABW' => 'Aruba',
            'AUS' => 'Australia',
            'AUT' => 'Austria',
            'AZE' => 'Azerbaijan',
            'BHS' => 'Bahamas',
            'BHR' => 'Bahrain',
            'BGD' => 'Bangladesh',
            'BRB' => 'Barbados',
            'BLR' => 'Belarus',
            'BEL' => 'Belgium',
            'BLZ' => 'Belize',
            'BEN' => 'Benin',
            'BMU' => 'Bermuda',
            'BTN' => 'Bhutan',
            'BOL' => 'Bolivia, Plurinational State of',
            'BES' => 'Bonaire, Sint Eustatius and Saba',
            'BIH' => 'Bosnia and Herzegovina',
            'BWA' => 'Botswana',
            'BVT' => 'Bouvet Island',
            'BRA' => 'Brazil',
            'IOT' => 'British Indian Ocean Territory',
            'BRN' => 'Brunei Darussalam',
            'BGR' => 'Bulgaria',
            'BFA' => 'Burkina Faso',
            'BDI' => 'Burundi',
            'KHM' => 'Cambodia',
            'CMR' => 'Cameroon',
            'CAN' => 'Canada',
            'CPV' => 'Cape Verde',
            'CYM' => 'Cayman Islands',
            'CAF' => 'Central African Republic',
            'TCD' => 'Chad',
            'CHL' => 'Chile',
            'CHN' => 'China',
            'CXR' => 'Christmas Island',
            'CCK' => 'Cocos (Keeling) Islands',
            'COL' => 'Colombia',
            'COM' => 'Comoros',
            'COG' => 'Congo',
            'COD' => 'Congo, the Democratic Republic of the',
            'COK' => 'Cook Islands',
            'CRI' => 'Costa Rica',
            'CIV' => 'Côte d\'Ivoire',
            'HRV' => 'Croatia',
            'CUB' => 'Cuba',
            'CUW' => 'Curaçao',
            'CYP' => 'Cyprus',
            'CZE' => 'Czech Republic',
            'DNK' => 'Denmark',
            'DJI' => 'Djibouti',
            'DMA' => 'Dominica',
            'DOM' => 'Dominican Republic',
            'ECU' => 'Ecuador',
            'EGY' => 'Egypt',
            'SLV' => 'El Salvador',
            'GNQ' => 'Equatorial Guinea',
            'ERI' => 'Eritrea',
            'EST' => 'Estonia',
            'ETH' => 'Ethiopia',
            'FLK' => 'Falkland Islands (Malvinas)',
            'FRO' => 'Faroe Islands',
            'FJI' => 'Fiji',
            'FIN' => 'Finland',
            'FRA' => 'France',
            'GUF' => 'French Guiana',
            'PYF' => 'French Polynesia',
            'ATF' => 'French Southern Territories',
            'GAB' => 'Gabon',
            'GMB' => 'Gambia',
            'GEO' => 'Georgia',
            'DEU' => 'Germany',
            'GHA' => 'Ghana',
            'GIB' => 'Gibraltar',
            'GRC' => 'Greece',
            'GRL' => 'Greenland',
            'GRD' => 'Grenada',
            'GLP' => 'Guadeloupe',
            'GUM' => 'Guam',
            'GTM' => 'Guatemala',
            'GGY' => 'Guernsey',
            'GIN' => 'Guinea',
            'GNB' => 'Guinea-Bissau',
            'GUY' => 'Guyana',
            'HTI' => 'Haiti',
            'HMD' => 'Heard Island and McDonald Islands',
            'VAT' => 'Holy See (Vatican City State)',
            'HND' => 'Honduras',
            'HKG' => 'Hong Kong',
            'HUN' => 'Hungary',
            'ISL' => 'Iceland',
            'IND' => 'India',
            'IDN' => 'Indonesia',
            'IRN' => 'Iran, Islamic Republic of',
            'IRQ' => 'Iraq',
            'IRL' => 'Ireland',
            'IMN' => 'Isle of Man',
            'ISR' => 'Israel',
            'ITA' => 'Italy',
            'JAM' => 'Jamaica',
            'JPN' => 'Japan',
            'JEY' => 'Jersey',
            'JOR' => 'Jordan',
            'KAZ' => 'Kazakhstan',
            'KEN' => 'Kenya',
            'KIR' => 'Kiribati',
            'PRK' => 'Korea, Democratic People\'s Republic of',
            'KOR' => 'Korea, Republic of',
            'KWT' => 'Kuwait',
            'KGZ' => 'Kyrgyzstan',
            'LAO' => 'Lao People\'s Democratic Republic',
            'LVA' => 'Latvia',
            'LBN' => 'Lebanon',
            'LSO' => 'Lesotho',
            'LBR' => 'Liberia',
            'LBY' => 'Libya',
            'LIE' => 'Liechtenstein',
            'LTU' => 'Lithuania',
            'LUX' => 'Luxembourg',
            'MAC' => 'Macao',
            'MKD' => 'Macedonia, the former Yugoslav Republic of',
            'MDG' => 'Madagascar',
            'MWI' => 'Malawi',
            'MYS' => 'Malaysia',
            'MDV' => 'Maldives',
            'MLI' => 'Mali',
            'MLT' => 'Malta',
            'MHL' => 'Marshall Islands',
            'MTQ' => 'Martinique',
            'MRT' => 'Mauritania',
            'MUS' => 'Mauritius',
            'MYT' => 'Mayotte',
            'MEX' => 'Mexico',
            'FSM' => 'Micronesia, Federated States of',
            'MDA' => 'Moldova, Republic of',
            'MCO' => 'Monaco',
            'MNG' => 'Mongolia',
            'MNE' => 'Montenegro',
            'MSR' => 'Montserrat',
            'MAR' => 'Morocco',
            'MOZ' => 'Mozambique',
            'MMR' => 'Myanmar',
            'NAM' => 'Namibia',
            'NRU' => 'Nauru',
            'NPL' => 'Nepal',
            'NLD' => 'Netherlands',
            'NCL' => 'New Caledonia',
            'NZL' => 'New Zealand',
            'NIC' => 'Nicaragua',
            'NER' => 'Niger',
            'NGA' => 'Nigeria',
            'NIU' => 'Niue',
            'NFK' => 'Norfolk Island',
            'MNP' => 'Northern Mariana Islands',
            'NOR' => 'Norway',
            'OMN' => 'Oman',
            'PAK' => 'Pakistan',
            'PLW' => 'Palau',
            'PSE' => 'Palestinian Territory, Occupied',
            'PAN' => 'Panama',
            'PNG' => 'Papua New Guinea',
            'PRY' => 'Paraguay',
            'PER' => 'Peru',
            'PHL' => 'Philippines',
            'PCN' => 'Pitcairn',
            'POL' => 'Poland',
            'PRT' => 'Portugal',
            'PRI' => 'Puerto Rico',
            'QAT' => 'Qatar',
            'REU' => 'Réunion',
            'ROU' => 'Romania',
            'RUS' => 'Russian Federation',
            'RWA' => 'Rwanda',
            'BLM' => 'Saint Barthélemy',
            'SHN' => 'Saint Helena, Ascension and Tristan da Cunha',
            'KNA' => 'Saint Kitts and Nevis',
            'LCA' => 'Saint Lucia',
            'MAF' => 'Saint Martin (French part)',
            'SPM' => 'Saint Pierre and Miquelon',
            'VCT' => 'Saint Vincent and the Grenadines',
            'WSM' => 'Samoa',
            'SMR' => 'San Marino',
            'STP' => 'Sao Tome and Principe',
            'SAU' => 'Saudi Arabia',
            'SEN' => 'Senegal',
            'SRB' => 'Serbia',
            'SYC' => 'Seychelles',
            'SLE' => 'Sierra Leone',
            'SGP' => 'Singapore',
            'SXM' => 'Sint Maarten (Dutch part)',
            'SVK' => 'Slovakia',
            'SVN' => 'Slovenia',
            'SLB' => 'Solomon Islands',
            'SOM' => 'Somalia',
            'ZAF' => 'South Africa',
            'SGS' => 'South Georgia and the South Sandwich Islands',
            'SSD' => 'South Sudan',
            'ESP' => 'Spain',
            'LKA' => 'Sri Lanka',
            'SDN' => 'Sudan',
            'SUR' => 'Suriname',
            'SJM' => 'Svalbard and Jan Mayen',
            'SWZ' => 'Swaziland',
            'SWE' => 'Sweden',
            'CHE' => 'Switzerland',
            'SYR' => 'Syrian Arab Republic',
            'TWN' => 'Taiwan, Province of China',
            'TJK' => 'Tajikistan',
            'TZA' => 'Tanzania, United Republic of',
            'THA' => 'Thailand',
            'TLS' => 'Timor-Leste',
            'TGO' => 'Togo',
            'TKL' => 'Tokelau',
            'TON' => 'Tonga',
            'TTO' => 'Trinidad and Tobago',
            'TUN' => 'Tunisia',
            'TUR' => 'Turkey',
            'TKM' => 'Turkmenistan',
            'TCA' => 'Turks and Caicos Islands',
            'TUV' => 'Tuvalu',
            'UGA' => 'Uganda',
            'UKR' => 'Ukraine',
            'ARE' => 'United Arab Emirates',
            'GBR' => 'United Kingdom',
            'USA' => 'United States',
            'UMI' => 'United States Minor Outlying Islands',
            'URY' => 'Uruguay',
            'UZB' => 'Uzbekistan',
            'VUT' => 'Vanuatu',
            'VEN' => 'Venezuela, Bolivarian Republic of',
            'VNM' => 'Viet Nam',
            'VGB' => 'Virgin Islands, British',
            'VIR' => 'Virgin Islands, U.S.',
            'WLF' => 'Wallis and Futuna',
            'ESH' => 'Western Sahara',
            'YEM' => 'Yemen',
            'ZMB' => 'Zambia',
            'ZWE' => 'Zimbabwe',
        ];

        return $this->select($name, $list, $selected, $options);
    }

    /**
     * @param  $name
     * @param  null     $selected
     * @param  array    $options
     * @return string
     */
    public function selectCountryNumeric($name, $selected = null, $options = array())
    {
        $list = [
            ''    => 'Select One...',
            '4'   => 'Afghanistan',
            '248' => 'Åland Islands',
            '8'   => 'Albania',
            '12'  => 'Algeria',
            '16'  => 'American Samoa',
            '20'  => 'Andorra',
            '24'  => 'Angola',
            '660' => 'Anguilla',
            '10'  => 'Antarctica',
            '28'  => 'Antigua and Barbuda',
            '32'  => 'Argentina',
            '51'  => 'Armenia',
            '533' => 'Aruba',
            '36'  => 'Australia',
            '40'  => 'Austria',
            '31'  => 'Azerbaijan',
            '44'  => 'Bahamas',
            '48'  => 'Bahrain',
            '50'  => 'Bangladesh',
            '52'  => 'Barbados',
            '112' => 'Belarus',
            '56'  => 'Belgium',
            '84'  => 'Belize',
            '204' => 'Benin',
            '60'  => 'Bermuda',
            '64'  => 'Bhutan',
            '68'  => 'Bolivia, Plurinational State of',
            '535' => 'Bonaire, Sint Eustatius and Saba',
            '70'  => 'Bosnia and Herzegovina',
            '72'  => 'Botswana',
            '74'  => 'Bouvet Island',
            '76'  => 'Brazil',
            '86'  => 'British Indian Ocean Territory',
            '96'  => 'Brunei Darussalam',
            '100' => 'Bulgaria',
            '854' => 'Burkina Faso',
            '108' => 'Burundi',
            '116' => 'Cambodia',
            '120' => 'Cameroon',
            '124' => 'Canada',
            '132' => 'Cape Verde',
            '136' => 'Cayman Islands',
            '140' => 'Central African Republic',
            '148' => 'Chad',
            '152' => 'Chile',
            '156' => 'China',
            '162' => 'Christmas Island',
            '166' => 'Cocos (Keeling) Islands',
            '170' => 'Colombia',
            '174' => 'Comoros',
            '178' => 'Congo',
            '180' => 'Congo, the Democratic Republic of the',
            '184' => 'Cook Islands',
            '188' => 'Costa Rica',
            '384' => 'Côte d\'Ivoire',
            '191' => 'Croatia',
            '192' => 'Cuba',
            '531' => 'Curaçao',
            '196' => 'Cyprus',
            '203' => 'Czech Republic',
            '208' => 'Denmark',
            '262' => 'Djibouti',
            '212' => 'Dominica',
            '214' => 'Dominican Republic',
            '218' => 'Ecuador',
            '818' => 'Egypt',
            '222' => 'El Salvador',
            '226' => 'Equatorial Guinea',
            '232' => 'Eritrea',
            '233' => 'Estonia',
            '231' => 'Ethiopia',
            '238' => 'Falkland Islands (Malvinas)',
            '234' => 'Faroe Islands',
            '242' => 'Fiji',
            '246' => 'Finland',
            '250' => 'France',
            '254' => 'French Guiana',
            '258' => 'French Polynesia',
            '260' => 'French Southern Territories',
            '266' => 'Gabon',
            '270' => 'Gambia',
            '268' => 'Georgia',
            '276' => 'Germany',
            '288' => 'Ghana',
            '292' => 'Gibraltar',
            '300' => 'Greece',
            '304' => 'Greenland',
            '308' => 'Grenada',
            '312' => 'Guadeloupe',
            '316' => 'Guam',
            '320' => 'Guatemala',
            '831' => 'Guernsey',
            '324' => 'Guinea',
            '624' => 'Guinea-Bissau',
            '328' => 'Guyana',
            '332' => 'Haiti',
            '334' => 'Heard Island and McDonald Islands',
            '336' => 'Holy See (Vatican City State)',
            '340' => 'Honduras',
            '344' => 'Hong Kong',
            '348' => 'Hungary',
            '352' => 'Iceland',
            '356' => 'India',
            '360' => 'Indonesia',
            '364' => 'Iran, Islamic Republic of',
            '368' => 'Iraq',
            '372' => 'Ireland',
            '833' => 'Isle of Man',
            '376' => 'Israel',
            '380' => 'Italy',
            '388' => 'Jamaica',
            '392' => 'Japan',
            '832' => 'Jersey',
            '400' => 'Jordan',
            '398' => 'Kazakhstan',
            '404' => 'Kenya',
            '296' => 'Kiribati',
            '408' => 'Korea, Democratic People\'s Republic of',
            '410' => 'Korea, Republic of',
            '414' => 'Kuwait',
            '417' => 'Kyrgyzstan',
            '418' => 'Lao People\'s Democratic Republic',
            '428' => 'Latvia',
            '422' => 'Lebanon',
            '426' => 'Lesotho',
            '430' => 'Liberia',
            '434' => 'Libya',
            '438' => 'Liechtenstein',
            '440' => 'Lithuania',
            '442' => 'Luxembourg',
            '446' => 'Macao',
            '807' => 'Macedonia, the former Yugoslav Republic of',
            '450' => 'Madagascar',
            '454' => 'Malawi',
            '458' => 'Malaysia',
            '462' => 'Maldives',
            '466' => 'Mali',
            '470' => 'Malta',
            '584' => 'Marshall Islands',
            '474' => 'Martinique',
            '478' => 'Mauritania',
            '480' => 'Mauritius',
            '175' => 'Mayotte',
            '484' => 'Mexico',
            '583' => 'Micronesia, Federated States of',
            '498' => 'Moldova, Republic of',
            '492' => 'Monaco',
            '496' => 'Mongolia',
            '499' => 'Montenegro',
            '500' => 'Montserrat',
            '504' => 'Morocco',
            '508' => 'Mozambique',
            '104' => 'Myanmar',
            '516' => 'Namibia',
            '520' => 'Nauru',
            '524' => 'Nepal',
            '528' => 'Netherlands',
            '540' => 'New Caledonia',
            '554' => 'New Zealand',
            '558' => 'Nicaragua',
            '562' => 'Niger',
            '566' => 'Nigeria',
            '570' => 'Niue',
            '574' => 'Norfolk Island',
            '580' => 'Northern Mariana Islands',
            '578' => 'Norway',
            '512' => 'Oman',
            '586' => 'Pakistan',
            '585' => 'Palau',
            '275' => 'Palestinian Territory, Occupied',
            '591' => 'Panama',
            '598' => 'Papua New Guinea',
            '600' => 'Paraguay',
            '604' => 'Peru',
            '608' => 'Philippines',
            '612' => 'Pitcairn',
            '616' => 'Poland',
            '620' => 'Portugal',
            '630' => 'Puerto Rico',
            '634' => 'Qatar',
            '638' => 'Réunion',
            '642' => 'Romania',
            '643' => 'Russian Federation',
            '646' => 'Rwanda',
            '652' => 'Saint Barthélemy',
            '654' => 'Saint Helena, Ascension and Tristan da Cunha',
            '659' => 'Saint Kitts and Nevis',
            '662' => 'Saint Lucia',
            '663' => 'Saint Martin (French part)',
            '666' => 'Saint Pierre and Miquelon',
            '670' => 'Saint Vincent and the Grenadines',
            '882' => 'Samoa',
            '674' => 'San Marino',
            '678' => 'Sao Tome and Principe',
            '682' => 'Saudi Arabia',
            '686' => 'Senegal',
            '688' => 'Serbia',
            '690' => 'Seychelles',
            '694' => 'Sierra Leone',
            '702' => 'Singapore',
            '534' => 'Sint Maarten (Dutch part)',
            '703' => 'Slovakia',
            '705' => 'Slovenia',
            '90'  => 'Solomon Islands',
            '706' => 'Somalia',
            '710' => 'South Africa',
            '239' => 'South Georgia and the South Sandwich Islands',
            '728' => 'South Sudan',
            '724' => 'Spain',
            '144' => 'Sri Lanka',
            '729' => 'Sudan',
            '740' => 'Suriname',
            '744' => 'Svalbard and Jan Mayen',
            '748' => 'Swaziland',
            '752' => 'Sweden',
            '756' => 'Switzerland',
            '760' => 'Syrian Arab Republic',
            '158' => 'Taiwan, Province of China',
            '762' => 'Tajikistan',
            '834' => 'Tanzania, United Republic of',
            '764' => 'Thailand',
            '626' => 'Timor-Leste',
            '768' => 'Togo',
            '772' => 'Tokelau',
            '776' => 'Tonga',
            '780' => 'Trinidad and Tobago',
            '788' => 'Tunisia',
            '792' => 'Turkey',
            '795' => 'Turkmenistan',
            '796' => 'Turks and Caicos Islands',
            '798' => 'Tuvalu',
            '800' => 'Uganda',
            '804' => 'Ukraine',
            '784' => 'United Arab Emirates',
            '826' => 'United Kingdom',
            '840' => 'United States',
            '581' => 'United States Minor Outlying Islands',
            '858' => 'Uruguay',
            '860' => 'Uzbekistan',
            '548' => 'Vanuatu',
            '862' => 'Venezuela, Bolivarian Republic of',
            '704' => 'Viet Nam',
            '92'  => 'Virgin Islands, British',
            '850' => 'Virgin Islands, U.S.',
            '876' => 'Wallis and Futuna',
            '732' => 'Western Sahara',
            '887' => 'Yemen',
            '894' => 'Zambia',
            '716' => 'Zimbabwe',
        ];

        return $this->select($name, $list, $selected, $options);
    }

    /**
     * @param  $name
     * @param  null    $selected
     * @param  array   $options
     * @return mixed
     */
    public function selectTimezone($name, $selected = null, $options = array())
    {
        $list = [];
        $utc  = new \DateTimeZone('UTC');
        $dt   = new \DateTime('now', $utc);

        foreach (\DateTimeZone::listIdentifiers() as $tz) {
            $current_tz = new \DateTimeZone($tz);
            $offset     = $current_tz->getOffset($dt);
            $transition = $current_tz->getTransitions($dt->getTimestamp(), $dt->getTimestamp());
            $abbr       = $transition[0]['abbr'];

            $list[$tz] = $tz . ' [' . $abbr . ' ' . $this->formatOffset($offset) . ']';
        }

        return $this->select($name, $list, $selected, $options);
    }

    /**
     * @param  $offset
     * @return string
     */
    private function formatOffset($offset)
    {
        $hours     = $offset / 3600;
        $remainder = $offset % 3600;
        $sign      = $hours > 0 ? '+' : '-';
        $hour      = (int) abs($hours);
        $minutes   = (int) abs($remainder / 60);

        if ($hour == 0 && $minutes == 0) {
            $sign = ' ';
        }
        return $sign . str_pad($hour, 2, '0', STR_PAD_LEFT) . ':' . str_pad($minutes, 2, '0');
    }
}