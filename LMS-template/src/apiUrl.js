'use strict'

const baseApiUrlLocal = 'http://127.0.0.1:8000/api/'
module.exports = {
    exam_post: baseApiUrlLocal + 'exam/',
    question_post: baseApiUrlLocal + 'question/',
    exam_edit: baseApiUrlLocal + 'exam/',
    result_post: baseApiUrlLocal + 'result/',
    student_list_exam: baseApiUrlLocal + 'exam/student/',
}