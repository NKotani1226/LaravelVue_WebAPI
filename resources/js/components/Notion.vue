<template>
  <div>
    <ul>
      <li v-for="(item, index) in data" :key="index">
        <a :href="item.url">
          <p>{{ item["properties"]["名前"]["title"][0]["plain_text"] }}</p>
        </a>
      </li>
    </ul>
  </div>
</template>

<script>
export default {
  name: 'Notion',
  props: {
        data: {
            type: Array,
            required: true,
        },
    },
    mounted() {
        console.log(this.data);
    },
};
</script>

<style>
h1 {
  color: #42b983;
}
</style>
