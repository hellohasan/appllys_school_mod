import Vue from "vue";
import moment from "moment";

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
