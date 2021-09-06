import Vue from 'vue';
import Card from './Card';
import CustomCard from "./CustomCard";
import Button from './Button';
import VImage from "./VImage";
import ImageInput from "./ImageInput";
import {HasError, AlertError, AlertSuccess, Form} from 'vform'
import FormGroupInput from "./FormGroupInput";
import FormGroupSelect from "./FormGroupSelect";
import FormGroupToggle from "./FormGroupToggle";
import FormGroupTextarea from "./FormGroupTextarea";
import FormGroupImage from "./FormGroupImage";

window.Form = Form;
// Components that are registered globally.
[
  Card,
  CustomCard,
  FormGroupInput,
  FormGroupTextarea,
  FormGroupSelect,
  FormGroupToggle,
  FormGroupImage,
  Button,
  VImage,
  ImageInput,
  HasError,
  AlertError,
  AlertSuccess
].forEach(Component => {
  Vue.component(Component.name, Component)
})

Vue.component("pagination", require("laravel-vue-pagination"));

