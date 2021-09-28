export const general = [
  {
    path: "/profile",
    name: "profile",
    component: () => import(/*webpackChunkName: "js/profile"*/ "../components/Profile"),
    meta: {
      title: 'Profile',
      requireAuth: true,
    }
  },
  {
    path: "/password",
    name: "password",
    component: () => import(/*webpackChunkName: "js/password"*/ "../components/Password"),
    meta: {
      title: 'Password',
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
