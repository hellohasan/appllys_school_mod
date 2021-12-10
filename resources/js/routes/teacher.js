import i18n from '../plugins/i18n'

export const teacher = [
  {
    path: "/student-list",
    component: () => import(/*webpackChunkName: "js/student-list"*/"../components/Student/List"),
    name: "student-list",
    meta: {
      requireAuth: true,
      permissions: [
        'student-lists'
      ],
      title: i18n.tc('StudentList')
    }
  },{
    path: "/mark-input",
    component: () => import(/*webpackChunkName: "js/mark-input"*/"../components/Teacher/Mark/Input"),
    name: "mark-input",
    meta: {
      requireAuth: true,
      permissions: [
        'mark-input'
      ],
      title: i18n.tc('MarkInput')
    }
  },
];
