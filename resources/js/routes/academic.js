export const academic = [
  /*Academic Information*/
  {
    path: "/academic-session",
    component: require("../components/Academic/Session/Session").default,
    meta: {
      requireAuth: true,
      roles: ["Super Admin", 'Admin', 'Register']
    },
    children: [
      {
        path: "/",
        component: require("../components/Academic/Session").default,
        meta:{
          title: 'Academic Session'
        }
      },
      {
        path: "add",
        component: require("../components/Academic/Session/Add").default,
        meta: {
          title: 'Add Academic Session',
        }
      },
      {
        path: ":id/edit",
        component: require("../components/Academic/Session/Edit").default,
        meta: {
          title: 'Edit Academic Session',
        }
      }
    ]
  },
  {
    path: "/academic-class",
    component: require("../components/Academic/Class/Class").default,
    meta: {
      requireAuth: true,
      roles: ["Super Admin", 'Admin', 'Register']
    },
    children: [
      {
        path: "/",
        meta: {
          permissions: ["class-list"],
          title: 'Academic Classes',
        },
        component: require("../components/Academic/Class/Index").default
      },
      {
        path: "add",
        meta: {
          permissions: ["class-edit"],
          title: "Add Academic Class"
        },
        component: require("../components/Academic/Class/Add").default
      },
      {
        path: ":id/edit",
        meta: {
          permissions: ["class-edit"],
          title: "Edit Academic Class"
        },
        component: require("../components/Academic/Class/Edit").default
      }
    ]
  },
  {
    path: "/academic-grading",
    component: require("../components/Academic/Grading/Grading").default,
    meta: {
      requireAuth: true,
      roles: ["Super Admin", 'Admin', 'Register']
    },
    children: [
      {
        path: "/",
        meta: {
          permissions: ["grade-list"],
          title: "Grade List"
        },
        component: require("../components/Academic/Grading/Index").default
      },
      {
        path: "add",
        meta: {
          permissions: ["grade-create"],
          title: "Add Grade List"
        },
        component: require("../components/Academic/Grading/Add").default
      },
      {
        path: ":id/edit",
        meta: {
          permissions: ["grade-edit"],
          title: "Edit Grade List"
        },
        component: require("../components/Academic/Grading/Edit").default
      }
    ]
  },
  {
    path: "/academic-subject",
    component: require("../components/Academic/Subject/Subject").default,
    meta: {
      requireAuth: true,
      roles: ["Super Admin", 'Admin', 'Register']
    },
    children: [
      {
        path: "/",
        meta: {
          permissions: ["subject-list"],
          title: "Academic Subject List"
        },
        component: require("../components/Academic/Subject/Index").default
      },
      {
        path: "add",
        meta: {
          permissions: ["subject-create"],
          title: "Add Academic Subject"
        },
        component: require("../components/Academic/Subject/Add").default
      },
      {
        path: ":id/edit",
        meta: {
          permissions: ["subject-edit"],
          title: "Edit Academic Subject"
        },
        component: require("../components/Academic/Subject/Edit").default
      }
    ]
  },
  {
    path: "/academic-group",
    component: require("../components/Academic/Group/index").default,
    name: "academic-group",
    meta: {requireAuth: true,title: "Academic Groups"}
  },
  {
    path: "/academic-section",
    component: require("../components/Academic/Section").default,
    name: "academic-section",
    meta: {requireAuth: true,title: "Academic Sections"}
  },
  {
    path: "/academic-department",
    component: require("../components/Academic/Department/Index").default,
    name: "academic-department",
    meta: {requireAuth: true,title: "Academic Departments"}
  },
  {
    path: "/academic-year",
    component: require("../components/Academic/Year").default,
    name: "academic-year",
    meta: {requireAuth: true,title: "Academic Year"}
  },
  {
    path: "/class-periods",
    component: require("../components/Academic/ClassPeriod").default,
    name: "class-periods",
    meta: {
      requireAuth: true,
      roles: ["Super Admin", 'Admin'],
      title: "Class Period"
    }
  },
  {
    path: "/teachers",
    component: require("../components/Teacher/Teacher").default,
    meta: {
      requireAuth: true,
      roles: ["Super Admin", 'Admin', 'Register']
    },
    children: [
      {
        path: "/",
        meta: {
          permissions: ["teacher-index"],
          title: "Teacher List"
        },
        component: require("../components/Teacher/Index").default
      },
      {
        path: "add",
        component: require("../components/Teacher/Add").default,
        meta: {
          permissions: ["teacher-create"],
          title: "Create Teacher"
        },
      },
      {
        path: ":custom/edit",
        meta: {
          permissions: ["teacher-edit"],
          title: "Edit Teacher"
        },
        component: require("../components/Teacher/Edit").default
      }
    ]
  },
  /* Teacher Subject Assign Route  */
  {
    path: "/subject-assign",
    component: require("../components/Academic/SubjectAssign/SubjectAssign").default,
    meta: {
      requireAuth: true,
      roles: ["Super Admin", 'Admin', 'Register']
    },
    children: [
      {
        path: "/",
        meta: {
          permissions: ["subject-assign-index"],
          title: "Subject Assign"
        },
        component: require("../components/Academic/SubjectAssign/Index").default
      }
    ]
  },

]
