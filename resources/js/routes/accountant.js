import i18n from '../plugins/i18n'
export const accountant = [

  /*Salary Scale Route*/
  {
    path: "/salary-scale",
    component: require("../components/Academic/SalaryScale").default,
    name: "salary-scale",
    meta: { requireAuth: true, title: "Salary Scale" }
  },
  /*Salary Scale Route*/
  {
    path: "/manage-accounts",
    component: () => import(/*webpackChunkName: "js/manage-account"*/"../components/Accountant/ManageAccount"),
    name: "manage-accounts",
    meta: {
      requireAuth: true,
      permissions: [
        'manage-accounts'
      ],
      title: i18n.tc('ManageAccount')
    }
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
    component: () => import(/*webpackChunkName: "js/bill-receive"*/ "../components/Accountant/BillReceive/BillReceive"),
    meta: {
      requireAuth: true,
      roles: ["Super Admin", 'Admin', 'Accountant']
    },
    children: [
      {
        path: "/",
        component: () => import(/*webpackChunkName: "js/bill-receive-index"*/"../components/Accountant/BillReceive/Index"),
        meta: {
          title: i18n.tc('BillReceive'),
          permissions: ['bill-receive-list']
        }
      },
      {
        path: "new",
        component: () => import(/*webpackChunkName: "js/bill-receive-new"*/"../components/Accountant/BillReceive/New"),
        meta: {
          title: i18n.tc('NewReceive'),
          permissions: ['bill-receive-new']
        }
      },
      {
        path: ":custom/view",
        component: () => import(/*webpackChunkName: "js/bill-receive-view"*/"../components/Accountant/BillReceive/View"),
        meta: {
          title: i18n.tc('ViewReceive'),
          permissions: ['bill-receive-view']
        }
      }
    ]
  },

  /*Academic Expense Route List*/
  {
    path: "/expenses",
    component: () => import(/*webpackChunkName: "js/expenses"*/ "../components/Accountant/Expenses/Expenses"),
    meta: {
      requireAuth: true,
      roles: ["Super Admin", 'Admin', 'Accountant']
    },
    children: [
      {
        path: "/",
        component: () => import(/*webpackChunkName: "js/expenses-index"*/"../components/Accountant/Expenses/Index"),
        meta: {
          title: i18n.tc('ExpenseList'),
          permissions: ['expenses']
        }
      },
      {
        path: "create",
        component: () => import(/*webpackChunkName: "js/expenses-create"*/"../components/Accountant/Expenses/Create"),
        meta: {
          title: i18n.tc('NewExpense'),
          permissions: ['expenses-create']
        }
      },
      {
        path: ":custom/show",
        component: () => import(/*webpackChunkName: "js/expenses-show"*/"../components/Accountant/Expenses/Show"),
        meta: {
          title: i18n.tc('ShowExpense'),
          permissions: ['expenses-show']
        }
      }
    ]
  },

  /*Academic Salary Route List*/
  {
    path: "/salary",
    component: () => import(/*webpackChunkName: "js/salary"*/ "../components/Accountant/Salary/Salary"),
    meta: {
      requireAuth: true,
      roles: ["Super Admin", 'Admin', 'Accountant']
    },
    children: [
      {
        path: "/",
        component: () => import(/*webpackChunkName: "js/salary-index"*/"../components/Accountant/Salary/Index"),
        meta: {
          title: i18n.tc('SalaryList'),
          permissions: ['salary']
        }
      },
      {
        path: "create",
        component: () => import(/*webpackChunkName: "js/salary-create"*/"../components/Accountant/Salary/Create"),
        meta: {
          title: i18n.tc('NewSalary'),
          permissions: ['salary-create']
        }
      },
      {
        path: ":custom/show",
        component: () => import(/*webpackChunkName: "js/salary-show"*/"../components/Accountant/Salary/Show"),
        meta: {
          title: i18n.tc('ShowSalary'),
          permissions: ['salary-show']
        }
      }
    ]
  },

  /*Balance Transfer Route List*/
  {
    path: "/balance-transfer",
    component: () => import(/*webpackChunkName: "js/balance-transfer"*/ "../components/Accountant/BalanceTransfer/BalanceTransfer"),
    meta: {
      requireAuth: true,
      roles: ["Super Admin", 'Admin', 'Accountant']
    },
    children: [
      {
        path: "/",
        component: () => import(/*webpackChunkName: "js/balance-transfer-index"*/"../components/Accountant/BalanceTransfer/Index"),
        meta: {
          title: i18n.tc('BalanceTransferList'),
          permissions: ['balance-transfer']
        }
      },
      {
        path: "create",
        component: () => import(/*webpackChunkName: "js/balance-transfer-create"*/"../components/Accountant/BalanceTransfer/Create"),
        meta: {
          title: i18n.tc('NewBalanceTransfer'),
          permissions: ['balance-transfer-create']
        }
      },
      {
        path: ":custom/show",
        component: () => import(/*webpackChunkName: "js/balance-transfer-show"*/"../components/Accountant/BalanceTransfer/Show"),
        meta: {
          title: i18n.tc('ShowBalanceTransfer'),
          permissions: ['balance-transfer-show']
        }
      }
    ]
  },

  /*Transaction Log Route*/
  {
    path: "/transaction-logs",
    component: () => import(/*webpackChunkName: "js/transaction-logs"*/ "../components/Accountant/TransactionLog/Index"),
    name: "transaction-logs",
    meta: { requireAuth: true, title: i18n.tc("TransactionLog") }
  },
]
