export const admission = [
  {
    path: "/admissions",
    component: require("../components/Academic/Admission/Admission").default,
    meta: {
      requireAuth: true,
      roles: ["Super Admin", 'Admin', 'Register']
    },
    children: [
      {
        path: "/",
        meta: {
          permissions: ["admission-list"],
          title: "Admission List"
        },
        component: require("../components/Academic/Admission/Index").default
      },
      {
        path: "add",
        meta: {
          permissions: ["admission-create"],
          title: "New Admission"
        },
        component: require("../components/Academic/Admission/Add").default
      },
      {
        path: ":id/edit",
        meta: {
          permissions: ["admission-edit"],
          title: "Edit Admission"
        },
        component: require("../components/Academic/Admission/Edit").default
      },
      {
        path: "view/:custom",
        meta: {
          permissions: ["admission-view"],
          title: "Show Admission"
        },
        component: require("../components/Academic/Admission/View").default
      }
    ]
  },
]
