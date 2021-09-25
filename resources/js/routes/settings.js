export const settings = [
  {
    path: "/basic-setting",
    name: "basic-setting",
    meta: {requireAuth: true,title: 'Basic Setting'},
    component: require("../components/Settings/Basic").default
  },
  {
    path: "/email-setting",
    name: "email-setting",
    meta: {title: 'Email Setting',requireAuth: true},
    component: () => import(/*webpackChunkName: "js/email-setting"*/ "../components/Settings/Email"),
  },
  {
    path: "/email-template",
    name: "email-template",
    meta: {title: 'Email Template',requireAuth: true},
    component: () => import(/*webpackChunkName: "js/email-template"*/ "../components/Settings/EmailTemplate"),
  },
  {
    path: "/sms-setting",
    name: "sms-setting",
    meta: {title: 'SMS Setting',requireAuth: true},
    component: () => import(/*webpackChunkName: "js/sms-setting"*/ "../components/Settings/Sms"),
  },
  {
    path: "/image-setting",
    name: "image-setting",
    meta: {title: 'Image Setting',requireAuth: true},
    component: () => import(/*webpackChunkName: "js/image-setting"*/ "../components/Settings/ImageSetting"),
  },
]
