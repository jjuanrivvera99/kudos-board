<template>
  <div class="container-fluid">
    <div class="title">
      Project Boards
    </div>
    <div class="card" style="margin-top: 20px">
      <div class="card-body">
        <div class="row">
          <div v-for="board in projectBoards" :key="board.id" class="col-md-3" style="margin-bottom: 20px">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">{{ board.name }}</h5>
                <p class="card-text">
                  {{ board.description }}
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="title">
      Team Boards
    </div>
    <div class="card" style="margin-top: 20px">
      <div class="card-body">
        <div class="row">
          <div v-for="board in teamBoards" :key="board.id" class="col-md-3" style="margin-bottom: 20px">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">{{ board.name }}</h5>
                <p class="card-text">
                  {{ board.description }}
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="title"> Birthday Boards</div>
    <div class="card" style="margin-top: 20px">
      <div class="card-body">
        <div class="row">
          <div v-for="board in birthdayBoards" :key="board.id" class="col-md-3" style="margin-bottom: 20px">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">{{ board.name }}</h5>
                <p class="card-text">
                  {{ board.description }}
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div>
      <!-- <b-button v-b-modal.modal-1>Launch demo modal</b-button> -->

      <b-modal id="modal" title="Give Kudos" @ok="kudos">
        <div class="form-group">
          <label for="board_id">Board: </label>
          <select v-model.trim="kudosForm.board_id" name="board_id" class="form-select form form-control" aria-label="Default select example">
            <option selected>Select...</option>
            <option v-for="board in boards" :key="board.id" :value="board.id"> {{ board.name }}</option>
          </select>
        </div>
        <div class="form-group">
          <label for="message">Board: </label>
          <b-form-input v-model="kudosForm.message" name="message" placeholder="Kudos message..."></b-form-input>
        </div>
        <!-- <b-button type="submit" variant="primary" @submit.prevent="kudos">Submit</b-button> -->
      </b-modal>
    </div>

  </div>
</template>

<script>
import { Form } from 'vform'

export default {
  middleware: ['auth', 'verified'],
  data() {
    return {
      kudosForm: new Form({
        board_id: '',
        user_id: '',
        message: ''
      }),
      boards: [],
    }
  },
  computed: {
    projectBoards() {
      return this.boards.filter(board => board.type.slug === 'project')
    },
    birthdayBoards() {
      return this.boards.filter(board => board.type.slug === 'birthday')
    },
    teamBoards(){
      return this.boards.filter(board => board.type.slug === 'team')
    }
  },
  mounted() {
    this.getBoards()
    this.kudosForm.user_id = this.$auth.user.id
  },
  methods: {
    async getBoards() {
      const response = await this.$axios.get('/api/boards')
      this.boards = response.data.data
    },
    async kudos() {
      try {
        await this.kudosForm.post(`/api/boards/${this.kudosForm.board_id}/kudos`);

        this.$bvToast.toast('You have gave kudos to ', {
          title: `Yeah!`,
          variant: 'success',
          solid: true
        });
        this.$bvModal.hide('modal');
        this.kudosForm.reset();
      } catch (error) {

      }
    }
  },
}
</script>

<style lang="scss" scoped>
.title {
  font-size: 30px;
  font-weight: bold;
  margin-bottom: 20px;
  text-align: center;
  margin-top: 10px;
}
</style>
