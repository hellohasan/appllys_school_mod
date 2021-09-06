export const test = [
  {
    path: "/test-component",
    name: "test-component",
    component: () =>
      import(/*webpackChunkName: "test"*/ "../components/test/test/test/TestComponent"),
    meta: {
      requireAuth: true
    }
  },
  {
    path: "/test-datatable",
    name: "test-datatable",
    component: () =>
      import(/*webpackChunkName: "test"*/ "../components/test/DataTable2"),
    meta: {
      requireAuth: true
    }
  },
]
