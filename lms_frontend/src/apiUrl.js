'use strict'
// import store from './store'
const baseApiUrlLocal = 'http://localhost:8000/'
const baseApiUrlLocalExamples = 'http://127.0.0.1:8083/api/'
const baseApiUrlLocalClass = 'http://127.0.0.1:8085/api/'

module.exports = {
    // Tax Setting
    create_user                         : baseApiUrlLocal + 'user/create',
    del_user                            : baseApiUrlLocal + 'user/delete/',
    edit_user                           : baseApiUrlLocal + 'user/update',
    list_users                          : baseApiUrlLocal + 'user/list',
    list_roles                          : baseApiUrlLocal + 'role/list_role',
    list_permissions                    : baseApiUrlLocal + 'permission/list',
    create_permissions                  : baseApiUrlLocal + 'permission/create',
    edit_permissions                    : baseApiUrlLocal + 'permission/update',
    delete_permissions                  : baseApiUrlLocal + 'permission/delete/',
    //////////Exam///////////////////
    exam_post                           : baseApiUrlLocalExamples + 'exam/',
    question_post                       : baseApiUrlLocalExamples + 'question/',
    exam_edit                           : baseApiUrlLocalExamples + 'exam/',
    delete_exam                         : baseApiUrlLocalExamples + 'exam/',
    result_post                         : baseApiUrlLocalExamples + 'result/',
    student_list_exam                   : baseApiUrlLocalExamples + 'exam/student/',
    student_history                     : baseApiUrlLocalExamples + 'result/history/',

    ///////Class////////////////
    class_post                          : baseApiUrlLocalClass + 'class',
    list_class                          : baseApiUrlLocalClass + 'class',
    edit_class                          : baseApiUrlLocalClass + 'class',
    delete_class                        : baseApiUrlLocalClass + 'class',
    student_per_class                   : baseApiUrlLocalClass + 'class/studentClass',

    /////course////////////////////////////////

    course_post                         : baseApiUrlLocalClass + 'course',
    list_course                         : baseApiUrlLocalClass + 'course/',
    lesson                              : baseApiUrlLocalClass + 'lesson/',
    show_lesson                         : baseApiUrlLocalClass + 'lesson/show/',
    lesson_of_course                    : baseApiUrlLocalClass + 'course/lessoncourse',
    //////student//////////////////////////

    add_student                         : baseApiUrlLocalClass + 'student',
    list_student                        : baseApiUrlLocalClass + 'student',

    // File URL
  file_path:
  "http://localhost/LMS/class_api/public/uploads/course_img/",
  file_path1:
  "http://localhost/LMS/class_api/public/uploads/img/",
          

    // course for student
    student_course                      : baseApiUrlLocalClass + 'course/student/',
    
}