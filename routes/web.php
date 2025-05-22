<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\StudentManagementController;
use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\Admin\DocumentController;
use App\Http\Controllers\Student\StudentController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\StudentMiddleware;
use App\Http\Controllers\Admin\NoteController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AnnouncementController;
use App\Http\Controllers\Admin\AttestationController;
use App\Http\Controllers\Admin\ScheduleController;
use App\Http\Controllers\Student\StudentScheduleController;
use App\Http\Controllers\Student\StudentAttestationController;
use App\Http\Controllers\Student\StudentContactController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\TeacherController;

Route::get('/', function () {
    return view('welcome');
});

// Route de redirection intelligente vers le dashboard
Route::get('/dashboard', function () {
    if (auth()->check()) {
        if (auth()->user()->isAdmin()) {
            return redirect()->route('admin.dashboard');
        } else {
            return redirect()->route('student.dashboard');
        }
    }
    return redirect()->route('login');
})->name('dashboard');

// Route de test pour vérifier l'authentification
Route::get('/check-auth', function () {
    if (auth()->check()) {
        return [
            'authenticated' => true,
            'user' => [
                'id' => auth()->user()->id,
                'name' => auth()->user()->name,
                'email' => auth()->user()->email,
                'role' => auth()->user()->role
            ]
        ];
    }
    return ['authenticated' => false];
});

// Routes pour l'authentification
require __DIR__.'/auth.php';

// Routes pour l'administration
Route::middleware(['web', 'auth'])->group(function () {
    Route::middleware([AdminMiddleware::class])->prefix('admin')->name('admin.')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
        
        // Gestion des étudiants
        Route::get('/students', [AdminController::class, 'students'])->name('students.index');
        Route::get('/students/create', [StudentManagementController::class, 'create'])->name('students.create');
        Route::post('/students', [StudentManagementController::class, 'store'])->name('students.store');
        Route::get('/students/{student}/edit', [StudentManagementController::class, 'edit'])->name('students.edit');
        Route::put('/students/{student}', [StudentManagementController::class, 'update'])->name('students.update');
        Route::delete('/students/{student}', [StudentManagementController::class, 'destroy'])->name('students.destroy');
        Route::patch('/students/{student}/toggle-active', [StudentManagementController::class, 'toggleActive'])->name('students.toggle-active');
        
        // Gestion des cours
        Route::get('/courses', [CourseController::class, 'index'])->name('courses.index');
        Route::get('/courses/create', [CourseController::class, 'create'])->name('courses.create');
        Route::post('/courses', [CourseController::class, 'store'])->name('courses.store');
        Route::get('/courses/{course}', [CourseController::class, 'show'])->name('courses.show');
        Route::get('/courses/{course}/edit', [CourseController::class, 'edit'])->name('courses.edit');
        Route::put('/courses/{course}', [CourseController::class, 'update'])->name('courses.update');
        Route::delete('/courses/{course}', [CourseController::class, 'destroy'])->name('courses.destroy');
        
        // Gestion des documents
        Route::get('/documents', [DocumentController::class, 'index'])->name('documents.index');
        Route::get('/documents/create', [DocumentController::class, 'create'])->name('documents.create');
        Route::post('/documents', [DocumentController::class, 'store'])->name('documents.store');
        Route::patch('/documents/{document}/approve', [DocumentController::class, 'approve'])->name('documents.approve');
        Route::patch('/documents/{document}/reject', [DocumentController::class, 'reject'])->name('documents.reject');
        Route::get('/documents/{document}/download', [DocumentController::class, 'download'])->name('documents.download');

        // Gestion des notes
        Route::get('/notes', [NoteController::class, 'index'])->name('notes.index');
        Route::get('/notes/create', [NoteController::class, 'create'])->name('notes.create');
        Route::post('/notes', [NoteController::class, 'store'])->name('notes.store');
        Route::get('/notes/{note}/edit', [NoteController::class, 'edit'])->name('notes.edit');
        Route::put('/notes/{note}', [NoteController::class, 'update'])->name('notes.update');
        Route::delete('/notes/{note}', [NoteController::class, 'destroy'])->name('notes.destroy');
        Route::get('/courses/{course}/notes', [NoteController::class, 'showCourseNotes'])->name('courses.notes');

        // Gestion des annonces
        Route::get('/announcements', [AnnouncementController::class, 'index'])->name('announcements.index');
        Route::get('/announcements/create', [AnnouncementController::class, 'create'])->name('announcements.create');
        Route::post('/announcements', [AnnouncementController::class, 'store'])->name('announcements.store');
        Route::get('/announcements/{announcement}/edit', [AnnouncementController::class, 'edit'])->name('announcements.edit');
        Route::put('/announcements/{announcement}', [AnnouncementController::class, 'update'])->name('announcements.update');
        Route::delete('/announcements/{announcement}', [AnnouncementController::class, 'destroy'])->name('announcements.destroy');

        // Gestion des attestations
        Route::prefix('attestations')->name('attestations.')->group(function () {
            Route::get('/', [AttestationController::class, 'index'])->name('index');
            Route::get('/create', [AttestationController::class, 'create'])->name('create');
            Route::post('/', [AttestationController::class, 'store'])->name('store');
            Route::get('/mass-generate', [AttestationController::class, 'massGenerateForm'])->name('mass-generate');
            Route::post('/mass-generate', [AttestationController::class, 'generateMass'])->name('generate-mass');
            Route::get('/{attestation}', [AttestationController::class, 'show'])->name('show');
            Route::get('/{attestation}/pdf', [AttestationController::class, 'generatePDF'])->name('generate-pdf');
            Route::get('/{attestation}/download', [AttestationController::class, 'downloadPDF'])->name('download-pdf');
        });

        // Routes pour les emplois du temps
        Route::get('/schedules', [ScheduleController::class, 'index'])->name('schedules.index');
        Route::get('/schedules/create', [ScheduleController::class, 'create'])->name('schedules.create');
        Route::post('/schedules', [ScheduleController::class, 'store'])->name('schedules.store');
        Route::get('/schedules/{schedule}', [ScheduleController::class, 'show'])->name('schedules.show');
        Route::get('/schedules/{schedule}/edit', [ScheduleController::class, 'edit'])->name('schedules.edit');
        Route::put('/schedules/{schedule}', [ScheduleController::class, 'update'])->name('schedules.update');
        Route::delete('/schedules/{schedule}', [ScheduleController::class, 'destroy'])->name('schedules.destroy');

        // Gestion des contacts
        Route::get('/contacts', [ContactController::class, 'index'])->name('contacts.index');
        Route::get('/contacts/{contact}', [ContactController::class, 'show'])->name('contacts.show');
        Route::put('/contacts/{contact}', [ContactController::class, 'update'])->name('contacts.update');

        // Gestion des enseignants
        Route::resource('teachers', TeacherController::class);
    });

    // Routes pour les étudiants
    Route::middleware(['auth', 'verified', StudentMiddleware::class])->prefix('student')->name('student.')->group(function () {
        Route::get('/', [StudentController::class, 'dashboard'])->name('dashboard');
        Route::get('/profile', [StudentController::class, 'profile'])->name('profile');
        Route::put('/profile', [StudentController::class, 'updateProfile'])->name('profile.update');
        Route::put('/profile/password', [StudentController::class, 'updatePassword'])->name('password.update');
        Route::get('/documents', [StudentController::class, 'documents'])->name('documents');
        Route::post('/documents', [StudentController::class, 'uploadDocument'])->name('documents.upload');
        Route::get('/notes', [StudentController::class, 'notes'])->name('notes');
        Route::get('/announcements', [StudentController::class, 'announcements'])->name('announcements');
        
        // Emplois du temps
        Route::get('/schedule', [StudentScheduleController::class, 'index'])->name('schedule');
        
        // Attestations
        Route::get('/attestations', [StudentAttestationController::class, 'index'])->name('attestations');
        Route::get('/attestations/{attestation}', [StudentAttestationController::class, 'show'])->name('attestations.show');
        Route::get('/attestations/{attestation}/pdf', [StudentAttestationController::class, 'generatePDF'])->name('attestations.generate-pdf');
        
        // Contact administration
        Route::get('/contact', [StudentContactController::class, 'index'])->name('contact');
        Route::post('/contact', [StudentContactController::class, 'store'])->name('contact.store');
        Route::get('/contact/history', [StudentContactController::class, 'history'])->name('contact.history');
    });
});
