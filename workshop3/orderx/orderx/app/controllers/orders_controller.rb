class OrdersController < ApplicationController
  skip_before_filter :verify_authenticity_token

  def index
    @orders = Order.all
  end

  def show
    @order = Order.find(params[:id])
  end

  def new
  end

  def create
    @order = Order.new(customer_name: params[:customer_name])
    @order.save()
  end

  def destroy
    order = Order.find(params[:id])
    @customer_name = order.customer_name
    order.delete
  end
end
