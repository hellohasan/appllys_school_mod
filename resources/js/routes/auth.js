export const auth = [
  {
    path: "/login",
    component: require("../components/Auth/Login").default,
    name: "login",
    meta: {
      title: "Login"
    }
  },
  {
    path: "/register",
    component: require("../components/Auth/Register").default,
    name: "register",
    meta: {
      title: "Register"
    }
  },
  {
    path: "/forget",
    component: require("../components/Auth/Forget").default,
    name: "forget",
    meta: {
      title: "Forget Password"
    }
  }
]
