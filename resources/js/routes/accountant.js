import i18n from '../plugins/i18n'
export const accountant = [

  /*Salary Scale Route*/
  {
    path: "/salary-scale",
    component: require("../components/Academic/SalaryScale").default,
    name: "salary-scale",
    meta: {requireAuth: true, title: "Salary Scale"}
  },

  /*Bill item route list*/
  {
    path: "/bill-items",
    component: require("../components/Accountant/BillItem/Index").default,
    name: "bill-items",
    meta: {
      requireAuth: true,
      title: i18n.tc("BillItem")
    }
  },
  {
    path: "/bill-assigns",
    component: require("../components/Accountant/BillAssign/BillAssign").default,
    meta: {
      requireAuth: true,
      roles: ["Super Admin", 'Admin', 'Accountant']
    },
    children: [
      {
        path: "/",
        component: require("../components/Accountant/BillAssign/Index").default,
        meta: {
          title: i18n.tc('BillAssign')
        }
      },
      {
        path: "add",
        component: require("../components/Accountant/BillAssign/Add").default,
        meta: {
          title: i18n.tc('NewAssign'),
        }
      },
      {
        path: ":custom/view",
        component: require("../components/Accountant/BillAssign/View").default,
        meta: {
          title: i18n.tc('ViewAssign'),
          permissions: ['bill-assign-view']
        }
      }
    ]
  },
  /*Bill Receive Route List*/
  {
    path: "/bill-receive",
    component: require("../components/Accountant/BillReceive/BillReceive").default,
    meta: {
      requireAuth: true,
      roles: ["Super Admin", 'Admin', 'Accountant']
    },
    children: [
      {
        path: "/",
        component: require("../components/Accountant/BillReceive/Index").default,
        meta: {
          title: i18n.tc('BillReceive'),
          permissions: ['bill-receive-list']
        }
      },
      {
        path: "new",
        component: require("../components/Accountant/BillReceive/New").default,
        meta: {
          title: i18n.tc('NewReceive'),
          permissions: ['bill-receive-new']
        }
      },
      {
        path: ":custom/view",
        component: require("../components/Accountant/BillReceive/View").default,
        meta: {
          title: i18n.tc('ViewReceive'),
          permissions: ['bill-receive-view']
        }
      }
    ]
  },
]
