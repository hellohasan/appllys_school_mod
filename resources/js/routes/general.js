export const general = [
  {
    path: "/profile",
    name: "profile",
    component: () => import(/*webpackChunkName: "profile"*/ "../components/Profile"),
    meta: {
      title: 'Profile',
      requireAuth: true,
    }
  },
  {
    path: "/designations",
    component: require("../components/Academic/Designation").default,
    name: "designations",
    meta: {requireAuth: true,title: "Designation"}
  },
]
