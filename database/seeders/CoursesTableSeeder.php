<?php

namespace Database\Seeders;

use App\Models\Course;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CoursesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     *
     */



    // php artisan db:seed --class=CoursesTableSeeder


    public function run(): void
    {
        Course::insert([
            [
                "id_course"=> '1' ,
                "name"=>' فيزياء 1' ,
                "chapter"=> 'الأول',
                "year_related"=> 'الأولى',
                "mark"=>'fragmented'

            ],
            [
                "id_course"=> '2' ,
                "name"=>'تحليل 1' ,
                "chapter"=> 'الأول',
                "year_related"=> 'الأولى',
                "mark"=>'fragmented'

            ], [
                "id_course"=> '3' ,
                "name"=>'برمجة 1' ,
                "chapter"=> 'الاول',
                "year_related"=> 'الاولى',
                "mark"=>'fragmented'

            ], [
                "id_course"=> '4' ,
                "name"=>'مبادئ عمل الحاسب' ,
                "chapter"=> 'الاول',
                "year_related"=> 'الاولى',
                "mark"=>'fragmented'

            ], [
                "id_course"=> '5' ,
                "name"=>'جبر خطي' ,
                "chapter"=> 'الاول',
                "year_related"=> 'الاولى',
                "mark"=>'fragmented'

            ], [
                "id_course"=> '6' ,
                "name"=>'لغة اجنبية 1' ,
                "chapter"=> 'الاول',
                "year_related"=> 'الاولى',
                "mark"=>'full'

            ], [
                "id_course"=> '7' ,
                "name"=>'ثقافة وحضارة' ,
                "chapter"=> 'الاول',
                "year_related"=> 'الاولى',
                "mark"=>'full'

            ], [
                "id_course"=> '9' ,
                "name"=>'فيزياء 2' ,
                "chapter"=> 'الثاني',
                "year_related"=> 'الاولى',
                "mark"=>'fragmented'

            ], [
                "id_course"=> '10' ,
                "name"=>'تحليل 2' ,
                "chapter"=> 'الثاني',
                "year_related"=> 'الاولى',
                "mark"=>'fragmented'

            ], [
                "id_course"=> '11' ,
                "name"=>'برمجة 2 ' ,
                "chapter"=> 'الثاني',
                "year_related"=> 'الاولى',
                "mark"=>'fragmented'

            ], [
                "id_course"=> '12' ,
                "name"=>'رياضيات متقطعة' ,
                "chapter"=> 'الثاني',
                "year_related"=> 'الاولى',
                "mark"=>'fragmented'

            ], [
                "id_course"=> '13' ,
                "name"=>'دارات كهربائية' ,
                "chapter"=> 'الثاني',
                "year_related"=> 'الاولى',
                "mark"=>'fragmented'

            ], [
                "id_course"=> '14' ,
                "name"=>'لغة احنبية 2' ,
                "chapter"=> 'الثاني',
                "year_related"=> 'الاولى',
                "mark"=>'fragmented'

            ], [
                "id_course"=> '15' ,
                "name"=>'لغة عربية ' ,
                "chapter"=> 'الثاني',
                "year_related"=> 'الاولى',
                "mark"=>'full'

            ], [
                "id_course"=> '17' ,
                "name"=>'برمجة 3' ,
                "chapter"=> 'الاول',
                "year_related"=> 'الثانية',
                "mark"=>'fragmented'

            ], [
                "id_course"=> '18' ,
                "name"=>'برمجة رياضية' ,
                "chapter"=> 'الاول',
                "year_related"=> 'الثانية',
                "mark"=>'fragmented'

            ], [
                "id_course"=> '19' ,
                "name"=>'احتمالات' ,
                "chapter"=> 'الاول',
                "year_related"=> 'الثانية',
                "mark"=>'fragmented'

            ], [
                "id_course"=> '20' ,
                "name"=>'تحليل عددي 1' ,
                "chapter"=> 'الاول',
                "year_related"=> 'الثانية',
                "mark"=>'fragmented'

            ], [
                "id_course"=> '21' ,
                "name"=>'تحليل 3' ,
                "chapter"=> 'الاول',
                "year_related"=> 'الثانية',
                "mark"=>'fragmented'

            ], [
                "id_course"=> '22' ,
                "name"=>'الكترونيات' ,
                "chapter"=> 'الاول',
                "year_related"=> 'الثانية',
                "mark"=>'fragmented'

            ], [
                "id_course"=> '23' ,
                "name"=>'لغة تخصصية 1' ,
                "chapter"=> 'الاول',
                "year_related"=> 'الثانية',
                "mark"=>'full'

            ], [
                "id_course"=> '25' ,
                "name"=>'خوارزميات وبنى معطيات 1' ,
                "chapter"=> 'الثاني',
                "year_related"=> 'الثانية',
                "mark"=>'fragmented'

            ], [
                "id_course"=> '26' ,
                "name"=>'تحليل عددي 2' ,
                "chapter"=> 'الثاني',
                "year_related"=> 'الثانية',
                "mark"=>'fragmented'

            ], [
                "id_course"=> '27' ,
                "name"=>'احصاء' ,
                "chapter"=> 'الثاني',
                "year_related"=> 'الثانية',
                "mark"=>'fragmented'

            ], [
                "id_course"=> '28' ,
                "name"=>'نظم ودارات منطقية' ,
                "chapter"=> 'الثاني',
                "year_related"=> 'الثانية',
                "mark"=>'fragmented'

            ], [
                "id_course"=> '29' ,
                "name"=>'تحليل 4' ,
                "chapter"=> 'الثاني',
                "year_related"=> 'الثانية',
                "mark"=>'fragmented'

            ], [
                "id_course"=> '30' ,
                "name"=>'مهارات تواصل' ,
                "chapter"=> 'الثاني',
                "year_related"=> 'الثانية',
                "mark"=>'fragmented'

            ], [
                "id_course"=> '31' ,
                "name"=>'لغة تخصصية 2' ,
                "chapter"=> 'الثاني',
                "year_related"=> 'الثانية',
                "mark"=>'full'

            ], [
                "id_course"=> '33' ,
                "name"=>'معالج مصغر' ,
                "chapter"=> 'الاول',
                "year_related"=> 'الثالثة',
                "mark"=>'fragmented'

            ], [
                "id_course"=> '34' ,
                "name"=>'خوارزميات وبنى معطيات 2' ,
                "chapter"=> 'الاول',
                "year_related"=> 'الثالثة',
                "mark"=>'fragmented'

            ], [
                "id_course"=> '35' ,
                "name"=>'معالجة اشارة' ,
                "chapter"=> 'الاول',
                "year_related"=> 'الثالثة',
                "mark"=>'fragmented'

            ], [
                "id_course"=> '36' ,
                "name"=>'نظرية المعلومات' ,
                "chapter"=> 'الاول',
                "year_related"=> 'الثالثة',
                "mark"=>'fragmented'

            ], [
                "id_course"=> '37' ,
                "name"=>'رسوميات حاسوبية' ,
                "chapter"=> 'الاول',
                "year_related"=> 'الثالثة',
                "mark"=>'fragmented'

            ], [
                "id_course"=> '38' ,
                "name"=>'نظرية المخططات' ,
                "chapter"=> 'الاول',
                "year_related"=> 'الثالثة',
                "mark"=>'fragmented'

            ], [
                "id_course"=> '39' ,
                "name"=>'قواعد معطيات 1' ,
                "chapter"=> 'الاول',
                "year_related"=> 'الثالثة',
                "mark"=>'fragmented'

            ], [
                "id_course"=> '41' ,
                "name"=>'هندسة برمجيات 1 ' ,
                "chapter"=> 'الثاني',
                "year_related"=> 'الثالثة',
                "mark"=>'fragmented'

            ], [
                "id_course"=> '42' ,
                "name"=>'بنية وتنظيم الحواسيب 1' ,
                "chapter"=> 'الثاني',
                "year_related"=> 'الثالثة',
                "mark"=>'fragmented'

            ], [
                "id_course"=> '43' ,
                "name"=>'شبكات حاسوبية' ,
                "chapter"=> 'الثاني',
                "year_related"=> 'الثالثة',
                "mark"=>'fragmented'

            ], [
                "id_course"=> '44' ,
                "name"=>'اتصالات تشابهية ورقيمية' ,
                "chapter"=> 'الثاني',
                "year_related"=> 'الثالثة',
                "mark"=>'fragmented'

            ], [
                "id_course"=> '45' ,
                "name"=>'خوارزميات وبنى معطيات 3' ,
                "chapter"=> 'الثاني',
                "year_related"=> 'الثالثة',
                "mark"=>'fragmented'

            ], [
                "id_course"=> '46' ,
                "name"=>'لغات صورية' ,
                "chapter"=> 'الثاني',
                "year_related"=> 'الثالثة',
                "mark"=>'fragmented'

            ], [
                "id_course"=> '47' ,
                "name"=>'مبادئ ذكاء صنعي' ,
                "chapter"=> 'الثاني',
                "year_related"=> 'الثالثة',
                "mark"=>'fragmented'

            ], [
                "id_course"=> '49' ,
                "name"=>'امن معلومات' ,
                "chapter"=> 'الاول',
                "year_related"=> 'الرابعة',
                "mark"=>'fragmented'

            ], [
                "id_course"=> '50' ,
                "name"=>'شبكات متقدمة' ,
                "chapter"=> 'الاول',
                "year_related"=> 'الرابعة',
                "mark"=>'fragmented'

            ], [
                "id_course"=> '51' ,
                "name"=>'نظم تشغيل 1' ,
                "chapter"=> 'الاول',
                "year_related"=> 'الرابعة',
                "mark"=>'fragmented'

            ], [
                "id_course"=> '52' ,
                "name"=>'بنية وتنظيم الحواسيب 2' ,
                "chapter"=> 'الاول',
                "year_related"=> 'الرابعة',
                "mark"=>'fragmented'

            ], [
                "id_course"=> '53' ,
                "name"=>'بحوث عمليات' ,
                "chapter"=> 'الاول',
                "year_related"=> 'الرابعة',
                "mark"=>'fragmented'
            ], [
                "id_course"=> '54' ,
                "name"=>'النظم الرقمية المبرمجة' ,
                "chapter"=> 'الاول',
                "year_related"=> 'الرابعة',
                "mark"=>'fragmented'

            ], [
                "id_course"=> '55' ,
                "name"=>'قواعد معطيات 2' ,
                "chapter"=> 'الاول',
                "year_related"=> 'الرابعة',
                "mark"=>'fragmented'

            ], [
                "id_course"=> '57' ,
                "name"=>'البرمجة التفرعية' ,
                "chapter"=> 'الثاني',
                "year_related"=> 'الرابعة',
                "mark"=>'fragmented'
            ], [
                "id_course"=> '58' ,
                "name"=>'نظم وسائط متعددة' ,
                "chapter"=> 'الثاني',
                "year_related"=> 'الرابعة',
                "mark"=>'fragmented'

            ], [
                "id_course"=> '59' ,
                "name"=>'التسويق وادارة المشاريع' ,
                "chapter"=> 'الثاني',
                "year_related"=> 'الرابعة',
                "mark"=>'fragmented'

            ], [
                "id_course"=> '60' ,
                "name"=>'تصميم مترجمات' ,
                "chapter"=> 'الثاني',
                "year_related"=> 'الرابعة',
                "mark"=>'fragmented'

            ], [
                "id_course"=> '62' ,
                "name"=>'روبوتية' ,
                "chapter"=> 'الثاني',
                "year_related"=> 'الرابعة',
                "mark"=>'fragmented'

            ], [
                "id_course"=> '64' ,
                "name"=>'تطبيقات انترنت' ,
                "chapter"=> 'الثاني',
                "year_related"=> 'الرابعة',
                "mark"=>'fragmented'

            ], [
                "id_course"=> '63' ,
                "name"=>'مشروع فصلي' ,
                "chapter"=> 'الثاني',
                "year_related"=> 'الرابعة',
                "mark"=>'fragmented'

            ], [
                "id_course"=> '65' ,
                "name"=>'التحكم المنطقي المبرمج plc' ,
                "chapter"=> 'الاول',
                "year_related"=> 'الخامسة',
                "mark"=>'fragmented'

            ], [
                "id_course"=> '67' ,
                "name"=>'النمذجة والمحاكاة' ,
                "chapter"=> 'الاول',
                "year_related"=> 'الخامسة',
                "mark"=>'fragmented'

            ], [
                "id_course"=> '68' ,
                "name"=>'نظم الزمن الحقيقي' ,
                "chapter"=> 'الاول',
                "year_related"=> 'الخامسة',
                "mark"=>'fragmented'

            ], [
                "id_course"=> '69' ,
                "name"=>'نظم خبيرة' ,
                "chapter"=> 'الاول',
                "year_related"=> 'الخامسة',
                "mark"=>'fragmented'

            ], [
                "id_course"=> '70' ,
                "name"=>'الرؤية الحاسوبية' ,
                "chapter"=> 'الاول',
                "year_related"=> 'الخامسة',
                "mark"=>'fragmented'

            ],
            [
                "id_course"=> '73' ,
                "name"=>'جودة ووثوقية' ,
                "chapter"=> 'الثاني',
                "year_related"=> 'الخامسة',
                "mark"=>'fragmented'
            ], [
                "id_course"=> '74' ,
                "name"=>'ادارة النظم الانتاجية' ,
                "chapter"=> 'الثاني',
                "year_related"=> 'الخامسة',
                "mark"=>'fragmented'

            ], [
                "id_course"=> '75' ,
                "name"=>'تنقيب معطيات' ,
                "chapter"=> 'الثاني',
                "year_related"=> 'الخامسة',
                "mark"=>'fragmented'

            ], [
                "id_course"=> '76' ,
                "name"=>'الشبكات اللاسلكية' ,
                "chapter"=> 'الثاني',
                "year_related"=> 'الخامسة',
                "mark"=>'fragmented'

            ],[
                "id_course"=> '77' ,
                "name"=>'مشروع تخرج' ,
                "chapter"=> 'الثاني',
                "year_related"=> 'الخامسة',
                "mark"=>'full'

            ],
        ]);
    }
}
