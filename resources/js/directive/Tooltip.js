import Vue from 'vue'

const bsTooltip = (el, binding) => {
  const t = []
  
  if (binding.modifiers.focus) t.push('focus')
  if (binding.modifiers.hover) t.push('hover')
  if (binding.modifiers.click) t.push('click')
  if (!t.length) t.push('hover')
  
  $(el).tooltip({
    title: binding.value,
    placement: binding.arg || 'top',
    trigger: t.join(' '),
    html: !!binding.modifiers.html,
  });
}

Vue.directive('tooltip', {
  bind: bsTooltip,
  update: bsTooltip,
  unbind (el) {
    $(el).tooltip('dispose')
  }
});
