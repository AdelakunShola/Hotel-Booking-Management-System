<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Backend\TeamController;
use App\Http\Controllers\Backend\RoomTypeController;
use App\Http\Controllers\Backend\RoomController;
use App\Http\Controllers\Frontend\FrontendRoomController;
use App\Http\Controllers\Frontend\BookingController;
use App\Http\Controllers\Backend\RoomListController;
use App\Http\Controllers\Backend\SettingController;
use App\Http\Controllers\Backend\TestimonialController;
use App\Http\Controllers\Backend\BlogController;
use App\Http\Controllers\Backend\FaqController;
use App\Http\Controllers\Backend\CommentController;
use App\Http\Controllers\Backend\ReportController;
use App\Http\Controllers\Backend\GalleryController;
use App\Http\Controllers\Backend\ContactController;
use App\Http\Controllers\Backend\RoleController;
use App\Models\Testimonial;

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', [UserController::class, 'Index']);


Route::get('/dashboard', function () {
    return view('frontend.dashboard.user_dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    Route::get('/profile', [UserController::class, 'UserProfile'])->name('user.profile');
    Route::post('/profile/store', [UserController::class, 'UserStore'])->name('profile.store');
    Route::get('/user/logout', [UserController::class, 'UserLogout'])->name('user.logout');
    Route::get('/user/change/password', [UserController::class, 'UserChangePassword'])->name('user.change.password');
    Route::post('/password/change/password', [UserController::class, 'ChangePasswordStore'])->name('password.change.store');
   
   
});

require __DIR__.'/auth.php';

// Admin Group Middleware 
Route::middleware(['auth','roles:admin'])->group(function(){
    
    Route::get('/admin/dashboard', [AdminController::class, 'AdminDashboard'])->name('admin.dashboard');
    Route::get('/admin/logout', [AdminController::class, 'AdminLogout'])->name('admin.logout');
    Route::get('/admin/profile', [AdminController::class, 'AdminProfile'])->name('admin.profile');
    Route::post('/admin/profile/store', [AdminController::class, 'AdminProfileStore'])->name('admin.profile.store');

    Route::get('/admin/change/password', [AdminController::class, 'AdminChangePassword'])->name('admin.change.password');
    Route::post('/admin/password/update', [AdminController::class, 'AdminPasswordUpdate'])->name('admin.password.update');

}); // End Admin Group Middleware 


Route::get('/admin/login', [AdminController::class, 'AdminLogin'])->name('admin.login');


// Admin Group Middleware 
Route::middleware(['auth','roles:admin'])->group(function(){

 /// Team All Route 
Route::controller(TeamController::class)->group(function(){

    Route::get('/all/team', 'AllTeam')->name('all.team')->middleware('permission:team.all');
    Route::get('/add/team', 'AddTeam')->name('add.team');
    Route::post('/team/store', 'StoreTeam')->name('team.store');
    Route::get('/edit/team/{id}', 'EditTeam')->name('edit.team');
    Route::post('/team/update', 'UpdateTeam')->name('team.update');
    Route::get('/delete/team/{id}', 'DeleteTeam')->name('delete.team');

});


 /// Book Area All Route 
 Route::controller(TeamController::class)->group(function(){

    Route::get('/book/area', 'BookArea')->name('book.area')->middleware('permission:bookarea.menu');
    Route::post('/book/area/update', 'BookAreaUpdate')->name('book.area.update')->middleware('permission:update.bookarea');
      
});

 ///Manage Room Type All Route 
 Route::controller(RoomTypeController::class)->group(function(){

    Route::get('/room/type/list', 'RoomTypeList')->name('room.type.list')->middleware('permission:room.type');
    Route::get('/add/room/type', 'AddRoomType')->name('add.room.type')->middleware('permission:room.type.add');
    Route::post('/room/type/store', 'RoomTypeStore')->name('room.type.store'); 
      
});

 /// Room All Route 
 Route::controller(RoomController::class)->group(function(){

    Route::get('/edit/room/{id}', 'EditRoom')->name('edit.room');
    Route::post('/update/room/{id}', 'UpdateRoom')->name('update.room');
    Route::get('/multi/image/delete/{id}', 'MultiImageDelete')->name('multi.image.delete');

    Route::post('/store/room/no/{id}', 'StoreRoomNumber')->name('store.room.no');
    Route::get('/edit/roomno/{id}', 'EditRoomNumber')->name('edit.roomno');
    Route::post('/update/roomno/{id}', 'UpdateRoomNumber')->name('update.roomno');
    Route::get('/delete/roomno/{id}', 'DeleteRoomNumber')->name('delete.roomno');

    Route::get('/delete/room/{id}', 'DeleteRoom')->name('delete.room');
      
});



 /// Admin Booking All Route 
 Route::controller(BookingController::class)->group(function(){

    Route::get('/booking/list', 'BookingList')->name('booking.list')->middleware('permission:booking.list');
    Route::get('/edit_booking/{id}', 'EditBooking')->name('edit_booking');
    Route::get('/download/invoice/{id}', 'DownloadInvoice')->name('download.invoice');
    
    
      
});


 /// Admin Room List All Route 
 Route::controller(RoomListController::class)->group(function(){

    Route::get('/view/room/list', 'ViewRoomList')->name('view.room.list')->middleware('permission:room.list');
    Route::get('/add/room/list', 'AddRoomList')->name('add.room.list'); 
    Route::post('/store/roomlist', 'StoreRoomList')->name('store.roomlist'); 
    
      
});



/// SMTP SETTING All Route 
Route::controller(SettingController::class)->group(function(){

    Route::get('/smtp/setting', 'SmtpSetting')->name('smtp.setting')->middleware('permission:setting.menu');
    Route::post('/smtp/update', 'SmtpUpdate')->name('smtp.update');
   
      
});



///Testimonial all route
Route::controller(TestimonialController::class)->group(function(){

    Route::get('/all/testimonial', 'AllTestimonial')->name('all.testimonial');
    Route::get('/add/testimonial', 'AddTestimonial')->name('add.testimonial'); 
    Route::post('/store/testimonial', 'StoreTestimonial')->name('testimonial.store'); 
    Route::get('/edit/testimonial/{id}', 'EditTestimonial')->name('edit.testimonial');
    Route::post('/update/testimonial', 'UpdateTestimonial')->name('testimonial.update'); 
    Route::get('/delete/testimonial/{id}', 'DeleteTestimonial')->name('delete.testimonial');
   
      
});


///blog category all route
Route::controller(BlogController::class)->group(function(){

    Route::get('/blog/category', 'BlogCategory')->name('blog.category')->middleware('permission:blog.category');
    Route::post('/store/blog/category', 'StoreBlogCategory')->name('store.blog.category');
    Route::get('/edit/blog/category/{id}', 'EditBlogCategory');
    Route::post('/update/blog/category', 'UpdateBlogCategory')->name('update.blog.category');
    Route::get('/delete/blog/category/{id}', 'DeleteBlogCategory')->name('delete.blog.category');
    
});



///all blog post all route
Route::controller(BlogController::class)->group(function(){

    Route::get('/all/blog/post', 'AllBlogPost')->name('all.blog.post')->middleware('permission:blog.post.list');
    Route::get('/add/blog/post', 'AddBlogPost')->name('add.blog.post');
    Route::post('/store/blog/post', 'StoreBlogPost')->name('store.blog.post');
    Route::get('/edit/blog/post/{id}', 'EditBlogPost')->name('edit.blog.post');
    Route::post('/update/blog/post', 'UpdateBlogPost')->name('update.blog.post');
    Route::get('/delete/blog/post/{id}', 'DeleteBlogPost')->name('delete.blog.post');


    
});



///faq all route
Route::controller(FaqController::class)->group(function(){

    Route::get('/all/faq', 'AllFaq')->name('all.faq')->middleware('permission:faq.menu');
    Route::post('/store/all/faq', 'StoreAllFaq')->name('store.all.faq');
    Route::get('/edit/all/faq/{id}', 'EditAllFaq');
    Route::post('/update/all/faq', 'UpdateAllFaq')->name('update.all.faq');
    Route::get('/delete/all/faq/{id}', 'DeleteAllFaq')->name('delete.all.faq');
    
});



///backend comment All Route 
Route::controller(CommentController::class)->group(function(){

    Route::get('/all/comment/', 'AllComment')->name('all.comment')->middleware('permission:comment.menu');
    Route::post('/update/comment/status', 'UpdateCommentStatus')->name('update.comment.status');
   
 
});



//booking report  All Route 
Route::controller(ReportController::class)->group(function(){

    Route::get('/booking/report/', 'BookingReport')->name('booking.report')->middleware('permission:booking.report.menu');
    Route::post('/search-by-date', 'SearchByDate')->name('search-by-date');
   
 
});



/// SITE SETTING All Route 
Route::controller(SettingController::class)->group(function(){

    Route::get('/site/setting', 'SiteSetting')->name('site.setting');
    Route::post('/site/update', 'SiteUpdate')->name('site.update');
   
      
});


/// Gallery All Route 
Route::controller(GalleryController::class)->group(function(){

    Route::get('/all/gallery', 'AllGallery')->name('all.gallery')->middleware('permission:gallery.menu');
    Route::get('/add/gallery', 'AddGallery')->name('add.gallery');
    Route::post('/store/gallery', 'StoreGallery')->name('store.gallery'); 
    Route::get('/edit/gallery/{id}', 'EditGallery')->name('edit.gallery');
    Route::post('/update/gallery', 'UpdateGallery')->name('update.gallery');
    Route::get('/delete/gallery/{id}', 'DeleteGallery')->name('delete.gallery');
    Route::post('/delete/gallery/multiple', 'DeleteGalleryMultiple')->name('delete.gallery.multiple');

});


/// backend contact message All Route 
Route::controller(ContactController::class)->group(function(){

    Route::get('/contact/message', 'AdminContactMessage')->name('contact.message')->middleware('permission:contact.message.menu');
   

});





///  All Permission Route 
Route::controller(RoleController::class)->group(function(){

    Route::get('/all/permission', 'AllPermission')->name('all.permission');
    Route::get('/add/permission', 'AddPermission')->name('add.permission');
    Route::post('/store/permission', 'StorePermission')->name('store.permission');
    Route::get('/edit/permission/{id}', 'EditPermission')->name('edit.permission');
    Route::post('/update/permission/{id}', 'UpdatePermission')->name('update.permission');
    Route::get('/delete/permission/{id}', 'DeletePermission')->name('delete.permission');


    Route::get('/import/permission', 'ImportPermission')->name('import.permission');
    Route::get('/export', 'Export')->name('export');
    Route::post('/import', 'Import')->name('import');
    
});



///  All Roles Route 
Route::controller(RoleController::class)->group(function(){

    Route::get('/all/roles', 'AllRoles')->name('all.roles');
    Route::get('/add/roles', 'AddRoles')->name('add.roles');
    Route::post('/store/roles', 'StoreRoles')->name('store.roles');
    Route::get('/edit/roles/{id}', 'EditRoles')->name('edit.roles');
    Route::post('/update/roles', 'UpdateRoles')->name('update.roles');
    Route::get('/delete/roles/{id}', 'DeleteRoles')->name('delete.roles');



    Route::get('/add/roles/permission', 'AddRolesPermission')->name('add.roles.permission');
    Route::post('/role/permission/store', 'RolePermissionStore')->name('role.permission.store');
    Route::get('/all/roles/permission', 'AllRolesPermission')->name('all.roles.permission');
    Route::get('/admin/edit/roles/{id}', 'AdminEditRoles')->name('admin.edit.roles');
    Route::post('/admin/roles/update/{id}', 'AdminRolesUpdate')->name('admin.roles.update');
    Route::get('/admin/delete/roles/{id}', 'AdminDeleteRoles')->name('admin.delete.roles');

    
    
});


/// Admin User All Route 
Route::controller(AdminController::class)->group(function(){

    Route::get('/all/admin', 'AllAdmin')->name('all.admin')->middleware('permission:admin.menu'); 
    Route::get('/add/admin', 'AddAdmin')->name('add.admin');
    Route::post('/store/admin', 'StoreAdmin')->name('store.admin');
    Route::get('/edit/admin/{id}', 'EditAdmin')->name('edit.admin');
    Route::post('/update/admin/{id}', 'UpdateAdmin')->name('update.admin');
    Route::get('/delete/admin/{id}', 'DeleteAdmin')->name('delete.admin');

});




}); // End Admin Group Middleware 


 /// Room All Route 
 Route::controller(FrontendRoomController::class)->group(function(){

    Route::get('/rooms/', 'AllFrontendRoomList')->name('froom.all');
    Route::get('/room/details/{id}', 'RoomDetailsPage');
    Route::get('/bookings/', 'BookingSeach')->name('booking.search');
    Route::get('/search/room/details/{id}', 'SearchRoomDetails')->name('search_room_details');

    Route::get('/check_room_availability/', 'CheckRoomAvailability')->name('check_room_availability');
 
});


// Auth Middleware User must have login for access this route 
Route::middleware(['auth'])->group(function(){

     /// CHECKOUT ALL Route 
 Route::controller(BookingController::class)->group(function(){

    Route::get('/checkout/', 'Checkout')->name('checkout');
    Route::post('/booking/store/', 'BookingStore')->name('user_booking_store');
    Route::post('/checkout/store/', 'CheckoutStore')->name('checkout.store');
    Route::match(['get', 'post'],'/stripe_pay', [BookingController::class, 'stripe_pay'])->name('stripe_pay');

    // booking Update 
    Route::post('/update/booking/status/{id}', 'UpdateBookingStatus')->name('update.booking.status');
    Route::post('/update/booking/{id}', 'UpdateBooking')->name('update.booking');

    // Assign Room Route 
    Route::get('/assign_room/{id}', 'AssignRoom')->name('assign_room');
    Route::get('/assign_room/store/{booking_id}/{room_number_id}', 'AssignRoomStore')->name('assign_room_store');
    Route::get('/assign_room_delete/{id}', 'AssignRoomDelete')->name('assign_room_delete');

 // user booking dashboard route
    Route::get('/user/booking', 'UserBooking')->name('user.booking');
    Route::get('/user/invoice/{id}', 'UserInvoice')->name('user.invoice');

 
});

}); // End Group Auth Middleware


///frontend blog  All Route 
Route::controller(BlogController::class)->group(function(){

    Route::get('/blog/details/{slug}', 'BlogDetails');
    Route::get('/blog/cat/list/{id}', 'BlogCatList');
    Route::get('/blog', 'BlogList')->name('blog.list');;
 
});


///frontend comment All Route 
Route::controller(CommentController::class)->group(function(){

    Route::post('/store/comment/', 'StoreComment')->name('store.comment');
   
 
});


/// Frontend Gallery All Route 
Route::controller(GalleryController::class)->group(function(){

    Route::get('/gallery', 'ShowGallery')->name('show.gallery');


});



/// Frontend contact us All Route 
Route::controller(ContactController::class)->group(function(){

    Route::get('/contact/us', 'ContactUs')->name('contact.us');
    Route::post('/store/contact', 'StoreContactUs')->name('store.contact');


});


/// Notification All Route 
Route::controller(BookingController::class)->group(function(){

    Route::post('/mark-notification-as-read/{notification}', 'MarkAsRead');


});



   