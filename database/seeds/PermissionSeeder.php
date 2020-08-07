<?php

use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*المستخدمين*/
        $permission1_id = DB::table('permissions')->insertGetId(['name' => 'users', 'guard_name' => 'web', 'title' => 'المستخدمين', 'icon' => 'group', 'link' => '', 'order_id' => 1, 'in_menu' => 1, 'parent_id' => 0]);
        $permission2_id = DB::table('permissions')->insertGetId(['name' => 'list users', 'guard_name' => 'web', 'title' => 'إدارة المستخدمين', 'icon' => 'fas fa-address-book', 'link' => '/admin/users', 'order_id' => 1, 'in_menu' => 1, 'parent_id' => $permission1_id]);
        $permission3_id = DB::table('permissions')->insertGetId(['name' => 'create users', 'guard_name' => 'web', 'title' => 'إضافة مستخدم', 'icon' => 'person_add', 'link' => '/admin/users/create', 'order_id' => 1, 'in_menu' => 1, 'parent_id' => $permission1_id]);
        $permission4_id = DB::table('permissions')->insertGetId(['name' => 'edit users', 'guard_name' => 'web', 'title' => 'تعديل مستخدم', 'icon' => 'equalizer', 'link' => '/admin/users/edit', 'order_id' => 1, 'in_menu' => 0, 'parent_id' => $permission1_id]);
        $permission5_id = DB::table('permissions')->insertGetId(['name' => 'delete users', 'guard_name' => 'web', 'title' => 'حذف مستخدم', 'icon' => 'equalizer', 'link' => '/admin/users/delete', 'order_id' => 1, 'in_menu' => 0, 'parent_id' => $permission1_id]);
        $permission6_id = DB::table('permissions')->insertGetId(['name' => 'permission users', 'guard_name' => 'web', 'title' => 'تحديد صلاحيات', 'icon' => 'equalizer', 'link' => '/admin/users/permission', 'order_id' => 1, 'in_menu' => 0, 'parent_id' => $permission1_id]);

        /*الأخبار*/
        $permission7_id = DB::table('permissions')->insertGetId(['name' => 'articles', 'guard_name' => 'web', 'title' => 'الأخبار', 'icon' => 'group', 'link' => '', 'order_id' => 2, 'in_menu' => 1, 'parent_id' => 0]);
        $permission8_id = DB::table('permissions')->insertGetId(['name' => 'list articles', 'guard_name' => 'web', 'title' => 'إدارة الأخبار', 'icon' => 'fas fa-address-book', 'link' => '/admin/articles', 'order_id' => 1, 'in_menu' => 1, 'parent_id' => $permission7_id]);
        $permission9_id = DB::table('permissions')->insertGetId(['name' => 'create articles', 'guard_name' => 'web', 'title' => 'إضافة الأخبار', 'icon' => 'person_add', 'link' => '/admin/articles/create', 'order_id' => 1, 'in_menu' => 1, 'parent_id' => $permission7_id]);
        $permission10_id = DB::table('permissions')->insertGetId(['name' => 'edit articles', 'guard_name' => 'web', 'title' => 'تعديل الأخبار', 'icon' => 'equalizer', 'link' => '/admin/articles/edit', 'order_id' => 1, 'in_menu' => 0, 'parent_id' => $permission7_id]);
        $permission11_id = DB::table('permissions')->insertGetId(['name' => 'delete articles', 'guard_name' => 'web', 'title' => 'حذف خبر', 'icon' => 'equalizer', 'link' => '/admin/articles/delete', 'order_id' => 1, 'in_menu' => 0, 'parent_id' => $permission7_id]);
        $permission38_id = DB::table('permissions')->insertGetId(['name' => 'approve articles', 'guard_name' => 'web', 'title' => 'قبول خبر', 'icon' => 'equalizer', 'link' => '/admin/articles/approve', 'order_id' => 1, 'in_menu' => 0, 'parent_id' => $permission7_id]);


        /*المشاريع*/
        $permission12_id = DB::table('permissions')->insertGetId(['name' => 'projects', 'guard_name' => 'web', 'title' => 'المشاريع', 'icon' => 'group', 'link' => '', 'order_id' => 2, 'in_menu' => 1, 'parent_id' => 0]);
        $permission13_id = DB::table('permissions')->insertGetId(['name' => 'list projects', 'guard_name' => 'web', 'title' => 'إدارة المشاريع', 'icon' => 'fas fa-address-book', 'link' => '/admin/projects', 'order_id' => 1, 'in_menu' => 1, 'parent_id' => $permission12_id]);
        $permission14_id = DB::table('permissions')->insertGetId(['name' => 'create projects', 'guard_name' => 'web', 'title' => 'إضافة مشروع', 'icon' => 'person_add', 'link' => '/admin/projects/create', 'order_id' => 1, 'in_menu' => 1, 'parent_id' => $permission12_id]);
        $permission15_id = DB::table('permissions')->insertGetId(['name' => 'edit projects', 'guard_name' => 'web', 'title' => 'تعديل مشروع', 'icon' => 'equalizer', 'link' => '/admin/projects/edit', 'order_id' => 1, 'in_menu' => 0, 'parent_id' => $permission12_id]);
        $permission16_id = DB::table('permissions')->insertGetId(['name' => 'delete projects', 'guard_name' => 'web', 'title' => 'حذف مشروع', 'icon' => 'equalizer', 'link' => '/admin/projects/delete', 'order_id' => 1, 'in_menu' => 0, 'parent_id' => $permission12_id]);

        /*التبرعات*/
        $permission17_id = DB::table('permissions')->insertGetId(['name' => 'donations', 'guard_name' => 'web', 'title' => 'التبرعات', 'icon' => 'group', 'link' => '', 'order_id' => 3, 'in_menu' => 1, 'parent_id' => 0]);
        $permission18_id = DB::table('permissions')->insertGetId(['name' => 'list donations', 'guard_name' => 'web', 'title' => 'إدارة التبرعات', 'icon' => 'fas fa-address-book', 'link' => '/admin/donations', 'order_id' => 1, 'in_menu' => 1, 'parent_id' => $permission17_id]);
        $permission19_id = DB::table('permissions')->insertGetId(['name' => 'show donations', 'guard_name' => 'web', 'title' => 'عرض تبرع', 'icon' => 'equalizer', 'link' => '/admin/donations/edit', 'order_id' => 1, 'in_menu' => 0, 'parent_id' => $permission17_id]);
        $permission20_id = DB::table('permissions')->insertGetId(['name' => 'delete donations', 'guard_name' => 'web', 'title' => 'حذف تبرع', 'icon' => 'equalizer', 'link' => '/admin/donations/delete', 'order_id' => 1, 'in_menu' => 0, 'parent_id' => $permission17_id]);


        /*الوسائط*/
        $permission21_id = DB::table('permissions')->insertGetId(['name' => 'medias', 'guard_name' => 'web', 'title' => 'الوسائط', 'icon' => 'group', 'link' => '', 'order_id' => 4, 'in_menu' => 1, 'parent_id' => 0]);
        $permission22_id = DB::table('permissions')->insertGetId(['name' => 'list medias', 'guard_name' => 'web', 'title' => 'إدارة الوسائط', 'icon' => 'fas fa-address-book', 'link' => '/admin/medias', 'order_id' => 1, 'in_menu' => 1, 'parent_id' => $permission21_id]);
        $permission23_id = DB::table('permissions')->insertGetId(['name' => 'create medias', 'guard_name' => 'web', 'title' => 'إضافة الوسائط', 'icon' => 'person_add', 'link' => '/admin/medias/create', 'order_id' => 1, 'in_menu' => 1, 'parent_id' => $permission21_id]);
        $permission24_id = DB::table('permissions')->insertGetId(['name' => 'edit medias', 'guard_name' => 'web', 'title' => 'تعديل الوسائط', 'icon' => 'equalizer', 'link' => '/admin/medias/edit', 'order_id' => 1, 'in_menu' => 0, 'parent_id' => $permission21_id]);
        $permission25_id = DB::table('permissions')->insertGetId(['name' => 'delete medias', 'guard_name' => 'web', 'title' => 'حذف الوسائط', 'icon' => 'equalizer', 'link' => '/admin/medias/delete', 'order_id' => 1, 'in_menu' => 0, 'parent_id' => $permission21_id]);

        /*فئات الأخبار*/
        $permission26_id = DB::table('permissions')->insertGetId(['name' => 'a_categories', 'guard_name' => 'web', 'title' => 'فئات الأخبار', 'icon' => 'group', 'link' => '', 'order_id' => 5, 'in_menu' => 1, 'parent_id' => 0]);
        $permission27_id = DB::table('permissions')->insertGetId(['name' => 'list a_categories', 'guard_name' => 'web', 'title' => 'إدارة فئات الاخبار', 'icon' => 'fas fa-address-book', 'link' => '/admin/a_categories', 'order_id' => 1, 'in_menu' => 1, 'parent_id' => $permission26_id]);
        $permission28_id = DB::table('permissions')->insertGetId(['name' => 'create a_categories', 'guard_name' => 'web', 'title' => 'إضافة فئة', 'icon' => 'person_add', 'link' => '/admin/a_categories/create', 'order_id' => 1, 'in_menu' => 1, 'parent_id' => $permission26_id]);
        $permission29_id = DB::table('permissions')->insertGetId(['name' => 'edit a_categories', 'guard_name' => 'web', 'title' => 'تعديل فئة', 'icon' => 'equalizer', 'link' => '/admin/a_categories/edit', 'order_id' => 1, 'in_menu' => 0, 'parent_id' => $permission26_id]);
        $permission30_id = DB::table('permissions')->insertGetId(['name' => 'delete a_categories', 'guard_name' => 'web', 'title' => 'حذف فئة', 'icon' => 'equalizer', 'link' => '/admin/a_categories/delete', 'order_id' => 1, 'in_menu' => 0, 'parent_id' => $permission26_id]);

        /*فئات المشاريع*/
        $permission31_id = DB::table('permissions')->insertGetId(['name' => 'p_categories', 'guard_name' => 'web', 'title' => 'فئات المشاريع', 'icon' => 'group', 'link' => '', 'order_id' => 6, 'in_menu' => 1, 'parent_id' => 0]);
        $permission32_id = DB::table('permissions')->insertGetId(['name' => 'list p_categories', 'guard_name' => 'web', 'title' => 'إدارة فئات المشاريع', 'icon' => 'fas fa-address-book', 'link' => '/admin/p_categories', 'order_id' => 1, 'in_menu' => 1, 'parent_id' => $permission31_id]);
        $permission33_id = DB::table('permissions')->insertGetId(['name' => 'create p_categories', 'guard_name' => 'web', 'title' => 'إضافة فئة', 'icon' => 'person_add', 'link' => '/admin/p_categories/create', 'order_id' => 1, 'in_menu' => 1, 'parent_id' => $permission31_id]);
        $permission34_id = DB::table('permissions')->insertGetId(['name' => 'edit p_categories', 'guard_name' => 'web', 'title' => 'تعديل فئة', 'icon' => 'equalizer', 'link' => '/admin/p_categories/edit', 'order_id' => 1, 'in_menu' => 0, 'parent_id' => $permission31_id]);
        $permission35_id = DB::table('permissions')->insertGetId(['name' => 'delete p_categories', 'guard_name' => 'web', 'title' => 'حذف فئة', 'icon' => 'equalizer', 'link' => '/admin/p_categories/delete', 'order_id' => 1, 'in_menu' => 0, 'parent_id' => $permission31_id]);


        /*اعدادات الموقع*/
        $permission36_id = DB::table('permissions')->insertGetId(['name' => 'settings', 'guard_name' => 'web', 'title' => 'اعدادات الموقع', 'icon' => 'group', 'link' => '', 'order_id' => 7, 'in_menu' => 1, 'parent_id' => 0]);
        $permission37_id = DB::table('permissions')->insertGetId(['name' => 'edit settings', 'guard_name' => 'web', 'title' => 'تعديل اعدادت الموقع', 'icon' => 'equalizer', 'link' => '/admin/settings/1/edit', 'order_id' => 1, 'in_menu' => 1, 'parent_id' => $permission36_id]);


        $user_id = DB::table('users')->insertGetId([
            'name' => 'الادمن',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('12345678'),
        ]);

        \App\User::find($user_id)->syncPermissions([
            $permission1_id,
            $permission2_id,
            $permission3_id,
            $permission4_id,
            $permission5_id,
            $permission6_id,
            $permission7_id,
            $permission8_id,
            $permission9_id,
            $permission10_id,
            $permission11_id,
            $permission12_id,
            $permission13_id,
            $permission14_id,
            $permission15_id,
            $permission16_id,
            $permission17_id,
            $permission18_id,
            $permission19_id,
            $permission20_id,
            $permission21_id,
            $permission22_id,
            $permission23_id,
            $permission24_id,
            $permission25_id,
            $permission26_id,
            $permission27_id,
            $permission28_id,
            $permission29_id,
            $permission30_id,
            $permission31_id,
            $permission32_id,
            $permission33_id,
            $permission34_id,
            $permission35_id,
            $permission36_id,
            $permission37_id,
            $permission38_id,
        ]);

        $setting_id = DB::table('settings')->insertGetId([
            'facebook' => 'required',
            'twitter' => 'required',
            'youtube' => 'required',
            'instagram' => 'required',
            'main_video' => 'required',
            'about_us_video' => 'required',
            'our_object_ar' => 'required',
            'our_mission_ar' => 'required',
            'our_active_ar' => 'required',
            'who_are_we_ar' => 'required',
            'our_vision_tilte_ar' => 'required',
            'our_vision_quotes_ar' => 'required',
            'our_vision_content_ar' => 'required',
            'our_object_en' => 'required',
            'our_mission_en' => 'required',
            'our_active_en' => 'required',
            'who_are_we_en' => 'required',
            'our_vision_tilte_en' => 'required',
            'our_vision_quotes_en' => 'required',
            'our_vision_content_en' => 'required',
            'our_object_tr' => 'required',
            'our_mission_tr' => 'required',
            'our_active_tr' => 'required',
            'who_are_we_tr' => 'required',
            'our_vision_tilte_tr' => 'required',
            'our_vision_quotes_tr' => 'required',
            'our_vision_content_tr' => 'required',

            'about_us_img' => 'required',
            'about_us_img2' => 'required',
            'media_img' => 'required',
            'our_vision_img' => 'required',
            'icon_img' => 'required',
            'page_img' => 'required',
            'main_img' => 'required',
            'donate_img' => 'required',
        ]);
    }
}
