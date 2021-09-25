export const test = [
  {
    path: "/test-component",
    name: "test-component",
    component: () =>
      import(/*webpackChunkName: "js/test-component"*/ "../components/test/test/test/TestComponent"),
    meta: {
      requireAuth: true
    }
  },
  {
    path: "/test-datatable",
    name: "test-datatable",
    component: () =>
      import(/*webpackChunkName: "js/test-datatable"*/ "../components/test/DataTable6"),
    meta: {
      requireAuth: true
    }
  },
]
