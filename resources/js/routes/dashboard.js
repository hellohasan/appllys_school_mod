export const dashboard = [
  /* After authentication route list */
  {
    path: "/dashboard",
    name: "dashboard",
    component: () =>
      import(/*webpackChunkName: "js/dashboard"*/ "../components/Dashboard"),
    meta: {
      title: "Dashboard",
      requireAuth: true
    }
  },
]
