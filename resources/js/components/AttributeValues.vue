<template>
  <div id="">
      <div class="tile">
          <h3 class="tile-title">Option Values</h3>
          <div class="tile-body">
              <div class="table-responsive">
                  <table class="table table-sm">
                      <thead>
                          <tr class="text-center">
                              <th>#</th>
                              <th>Value</th>
                              <th>Price</th>
                              <th>Action</th>
                          </tr>
                      </thead>
                      <tbody>
                          <tr v-for="(value, index) in values" :key="index">
                              <td style="width:25%" class="text-center">{{ value.id }}</td>
                              <td style="width:25%" class="text-center">{{ value.value }}</td>
                              <td style="width:25%" class="text-center">{{ value.price }}</td>
                              <td style="width:25%" class="text-center">
                                  <button class="btn btn-primary btn-sm" @click.stop="editAttributeValue(value)">
                                      <i class="fa fa-edit"></i>
                                  </button>
                                  <button class="btn btn-danger btn-sm" @click.stop="deleteAttribute(value)">
                                      <i class="fa fa-trash"></i>
                                  </button>
                              </td>
                          </tr>
                      </tbody>
                  </table>
                    <div class="tile">
                        <h3 class="tile-title">Attribute Values</h3>
                        <hr>
                        <div class="tile-body">
                            <div class="form-group">
                                <label for="value" class="control-label">Value</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    placeholder="Enter attribute value"
                                    id="value"
                                    name="value"
                                    v-model="value"
                                >
                            </div>
                            <div class="form-group">
                                <label for="price" class="control-label">Price</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    placeholder="Enter attribute value price"
                                    id="price"
                                    name="price"
                                    v-model="price"
                                >
                            </div>
                        </div>
                        <div class="tile-footer">
                            <div class="row d-print-none mt-2">
                                <div class="col-12 text-right">
                                    <button class="btn btn-success" type="submit" @click.stop="saveValue()" v-if="addValue">
                                        <i class="fa fa-fw fa-lg fa-check-circle"></i>Save
                                    </button>
                                    <button class="btn btn-success" type="submit" @click.stop="updateValue()" v-if="!addValue">
                                        <i class="fa fa-fw fa-lg fa-check-circle"></i>Update
                                    </button>
                                    <button class="btn btn-primary" type="submit" @click.stop="reset()" v-if="!addValue">
                                        <i class="fa fa-fw fa-lg fa-check-circle"></i>Reset
                                    </button>
                                </div>
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
    name:'attribute-values',
    props:['attributeid'],
    data(){
        return{
            values:[],
            value:'',
            price:'',
            currentId:'',
            addValue:true,
            key:0
        }
    },
    created(){
        this.loadValues();
    },
    methods:{
        loadValues(){
            let attributeId = this.attributeid
            axios.post('/admin/attributes/get-values',{
                id:this.attributeid
            }).then((res) => {
                this.values =res.data
            }).catch((err) => {
                console.log(err)
            });
        },
        saveValue(){
            if(this.value === ''){
                this.$swal('Error', 'Value for attribute is required.',{icon:'error'})
            }else{
                let attributeId = this.attributeid
                axios.post('/admin/attributes/add-values',{
                    id:this.attributeid,
                    value: this.value,
                    price: this.price
                }).then((res) => {
                    this.values.push(res.data)
                    this.resetValue()
                    this.$swal('Success! Value added successfully',{icon:'success'})
                }).catch((err) => {
                    console.log(err)
                });
            }
        },
        editAttributeValue(value){
            this.addValue = false
            this.value = value.value
            this.price = value.price
            this.currentId = value.id
            this.key = this.values.indexOf(value)
        },
        updateValue(){
            if(this.value ===''){
                this.$swal('Error, Value for attribute is required',{icon:'error'})
            }
            else{
                let attributeId = this.attributeid
                axios.post('/admin/attributes/update-values',{
                    id:attributeId,
                    value:this.value,
                    price:this.price,
                    valueId: this.currentId
                }).then((res) => {
                    this.values.splice(this.key,1)
                    this.resetValue(),
                    this.values.push(res.data)
                    this.$swal('Success! Value updated successfully',{icon:'success'})
                }).catch((err) => {
                    console.log(err)
                });
            }
        },
        deleteAttribute(value){
            this.$swal({
                title:'Are you sure?',
                text: 'Once deleted, you will not be able to recover this attribute value!',
                icon:'warning',
                buttons:true,
                dangerMode:true
            }).then((willDelete) => {
                if(willDelete){
                    this.currentId = value.id
                    this.key = this.values.indexOf(value)
                    axios.post('/admin/attributes/delete-values',{
                        id: this.currentId
                    }).then((res) => {
                        if(res.data.status === 'success'){
                            this.values.splice(this.key, 1)
                            this.resetValue()
                            this.$swal('Success! Option value has been deleted')
                        }else{
                            this.$swal('Your option value not deleted')
                        }
                    }).catch((err) => {
                        console.log(err)
                    });
                }
            })
        },
        resetValue(){
            this.value = '',
            this.price = ''
        },
        reset(){
            this.addValue = true,
            this.resetValue()
        }
    }
}
</script>
