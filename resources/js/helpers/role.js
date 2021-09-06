import store from '../store/index';

/**
 * @param {Array} value
 * @returns {Boolean}
 * @example see @/views/permission/Directive.vue
 */
export default function checkRole(value) {
  if (value && value instanceof Array && value.length > 0) {
    const roles = store.getters && store.state.roles;
    const requiredRoles = value;

    return roles.some(role => {
      return requiredRoles.includes(role);
    });
  } else {
    console.error(`Need roles! Like v-role="['admin','editor']"`);
    return false;
  }
}
