'use strict'
// import store from './store'
const baseApiUrlLocal = 'http://localhost:8000/'
const baseApiUrlLocalExamples = 'http://127.0.0.1:8083/api/'
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
    exam_post                           : baseApiUrlLocalExamples + 'exam',
    question_post                       : baseApiUrlLocalExamples + 'question',
    exam_edit                           : baseApiUrlLocalExamples + 'exam',
    delete_exam                         : baseApiUrlLocalExamples + 'exam/',
}