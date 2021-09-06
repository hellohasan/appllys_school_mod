export const users = [
  {
    path: "/users",
    component: require("../components/Users").default,
    name: "users",
    meta: {title: 'Users',requireAuth: true}
  },

  {
    path: "/roles",
    component: require("../components/role/Roles").default,
    name: "roles",
    meta: {title: 'Manage Roles',requireAuth: true, roles: ["Super Admin"]}
  },
  {
    path: "/permission",
    component: require("../components/permission/Permission").default,
    name: "permission",
    meta: {title: 'Manage Permissions',requireAuth: true, roles: ["Super Admin"]}
  },

  {
    path: "/customers",
    component: require("../components/customer/Customer").default,
    meta: {
      requireAuth: true
    },
    children: [
      {
        path: "/",
        component: require("../components/customer").default,
        meta: {
          title: 'Customers',
        }
      },
      {
        path: "add",
        component: require("../components/customer/Add").default,
        meta: {
          title: 'Create New Customer',
        }
      },
      {
        path: ":id",
        component: require("../components/customer/Show").default,
        meta: {
          title: 'Show Customer',
        }
      }
    ]
  },
]
