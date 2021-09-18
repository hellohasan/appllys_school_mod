import Vue from "vue";
import moment from "moment";
import store from '../store/index'
Vue.filter("capitalize", function(value) {
    if (!value) return "";
    value = value.toString();
    return value.charAt(0).toUpperCase() + value.slice(1);
});

Vue.filter("upperText", function(value) {
    if (!value) return "";
    value = value.toString();
    return value.toUpperCase();
});

Vue.filter("myDateTime", function(created) {
    return moment(created).format("MMMM Do YYYY, h:mm:ss A");
});

Vue.filter("myDate", function(created) {
    return moment(created).format("MMMM Do YYYY");
});

Vue.filter('withCurrencySymbol', function (amount){
  return '৳ '+amount;
})

Vue.filter('withCurrency', function (amount){
  if (store.state.locale === 'en'){
    return amount+' BDT';
  }else if (store.state.locale === 'bn'){
    return amount+' টাকা';
  }
  return '';
})

Vue.filter('students', function (data){
  if (store.state.locale === 'en'){
    return data+' Students';
  }else if (store.state.locale === 'bn'){
    return data+' শিক্ষার্থী';
  }
  return '';
})
