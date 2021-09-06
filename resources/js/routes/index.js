import {auth} from "./auth";
import {settings} from "./settings";
import {users} from "./users";
import {academic} from "./academic";
import {general} from "./general";
import {admission} from "./admission";
import {test} from "./test";
import {dashboard} from "./dashboard";
import {accountant} from "./accountant";
export const routes = [
  ...auth,
  ...dashboard,
  ...settings,
  ...users,
  ...academic,
  ...admission,
  ...general,
  ...test,
  ...accountant,

  /* 404 Page component */
  {path: "/unauthorized",meta:{title: "503"}, component: require("../components/503").default},
  {path: "*",meta:{title: "404"}, component: require("../components/404").default}
];
