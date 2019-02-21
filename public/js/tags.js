function _toConsumableArray(arr) {if (Array.isArray(arr)) {for (var i = 0, arr2 = Array(arr.length); i < arr.length; i++) {arr2[i] = arr[i];}return arr2;} else {return Array.from(arr);}}Vue.component('tags-input', {
  template: '\n    <div class="tags-input">\n      <span v-for="tag in value" class="tags-input-tag">\n        <span>{{ tag }}</span>\n        <button type="button" class="tags-input-remove" @click="removeTag(tag)">&times;</button>\n      </span>\n      <input class="tags-input-text" placeholder="Add tag..."\n        @keydown.enter.prevent="addTag"\n        v-model="newTag"\n      >\n    </div>\n  ',











  props: ['value'],
  data: function data() {
    return {
      newTag: '' };

  },
  methods: {
    addTag: function addTag() {
      if (this.newTag.trim().length === 0 || this.value.includes(this.newTag.trim())) {
        return;
      }
      this.$emit('input', [].concat(_toConsumableArray(this.value), [this.newTag.trim()]));
      this.newTag = '';
    },
    removeTag: function removeTag(tag) {
      this.$emit('input', this.value.filter(function (t) {return t !== tag;}));
    } } });



new Vue({
  el: '#app',
  data: {
    tags: [
    'Testing',
    'Design'] } });