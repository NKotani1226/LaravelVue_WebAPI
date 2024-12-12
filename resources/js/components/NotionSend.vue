<template>
  <div class="container mt-4">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">SEND NOTION</div>

          <div class="card-body">
            <div class="row">
              <div class="col-md-12">
                <form @submit.prevent="submitForm">
                  <div class="form-group d-flex align-items-center">
                    <label>Name</label>
                    <input 
                      class = "form-control ml-3" 
                      id = "name"
                      name = "name" 
                      v-model="formData.properties.Name.title[0].text.content"
                    />
                  </div>

                  <button class="btn btn-primary mt-4">
                    Submit
                  </button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'Notion',
  data() {
    return {
      formData: {
        properties: {
          Name: {
            title: [
              {
                text: {
                  content: "",
                },
              },
            ],
          },
        },
      },
      error: null,
      success: false,
    };
  },
  methods: {
    async submitForm() {
      try {
        this.error = null;
        this.success = false;
        const response = await axios.post('/notion/api/add-page', this.formData);
        this.success = true;
        console.log('Response:', response.data);
      } catch (error) {
        this.error = error.response?.data?.message || "An error occurred.";
        console.error('Error:', error);
      }
    },
  },
};
</script>

<style>
h1 {
  color: #42b983;
}
</style>
