from odoo import models, fields

class AccountMove(models.Model):
    _inherit = "account.move"
    
    project_address_id = fields.Many2one('res.partner')
    payment_state = fields.Selection(selection=[
        ('not_paid', 'Not Paid'),
        ('in_payment', 'Paid'),
        ('paid', 'Reconciled'),
        ('partial', 'Partially Paid'),
        ('reversed', 'Reversed'),
        ('invoicing_legacy', 'Invoicing App Legacy')],
        string="Payment Status", store=True, readonly=True, copy=False, tracking=True,
        compute='_compute_amount')    

