import store from '../store/index';

/**
 * @param {Array} value
 * @returns {Boolean}
 * @example see @/views/permission/Directive.vue
 */
export default function checkPermission(value) {
  if (value && value instanceof Array && value.length > 0) {
    const permissions = store.getters && store.state.permissions;
    const requiredPermissions = value;

    return permissions.some(permission => {
      return requiredPermissions.includes(permission);
    });
  } else {
    console.error(`Need permissions! Like v-permission="['manage permission','edit article']"`);
    return false;
  }
}
