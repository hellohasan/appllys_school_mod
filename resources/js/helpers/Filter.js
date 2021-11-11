import Vue from "vue";
import moment from "moment";
import store from '../store/index'
import * as converter from 'number-to-words'

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
    return moment(created).format("Do MMMM, YYYY, hh:mm:ss A");
});

Vue.filter("myDate", function(created) {
    return moment(created).format("Do MMMM, YYYY");
});

Vue.filter("date", function(created) {
    return moment(created).format("Do MMM, YYYY");
});

Vue.filter("myTime", function (time) {
  time = time.toString().match(/^([01]\d|2[0-3])(:)([0-5]\d)(:[0-5]\d)?$/) || [time];
  if (time.length > 1) { // If time format correct
    time = time.slice(1);  // Remove full string match value
    time[5] = +time[0] < 12 ? ' AM' : ' PM'; // Set AM/PM
    time[0] = +time[0] % 12 || 12; // Adjust hours
  }
  return time.join(''); // return adjusted time or original string
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

Vue.filter('toWords', function (value) {
  if (!value) return '';
  return 'Only '+converter.toWords(value);
})


Vue.filter('students', function (data){
  if (store.state.locale === 'en'){
    return data+' Students';
  }else if (store.state.locale === 'bn'){
    return data+' শিক্ষার্থী';
  }
  return '';
})

Vue.filter('items', function (data){
  if (store.state.locale === 'en'){
    return data+`'s`;
  }else if (store.state.locale === 'bn'){
    return data+' টি';
  }
  return '';
})

Vue.filter('numberConversion', function (data){
  if (store.state.locale === 'en'){
    return data;
  }else if (store.state.locale === 'bn'){
    return this.toBangla(data)
  }
  return '';
})



