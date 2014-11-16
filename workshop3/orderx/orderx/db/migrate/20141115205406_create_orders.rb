class CreateOrders < ActiveRecord::Migration
  def change
    create_table :orders do |t|
      t.text :customer_name

      t.timestamps
    end
  end
end
