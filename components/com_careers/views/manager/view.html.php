<?php defined('_JEXEC') or die;

class CareersViewManager extends JView
{
	public function display($tpl = null)
	{
		$this->items = $this->get('Items');
		$this->pagination = $this->get('Pagination');
		$this->state = $this->get('State');

		$this->lists = array(
			'order_Dir' => $this->state->get('list.direction'),
			'order'     => $this->state->get('list.ordering'),
			'search'    => $this->state->get('filter.search')
		);

		JFactory::getDocument()->addScriptDeclaration('
		// <![CDATA[
        $(function() {
            var sortableList = $("#sortable");
            sortableList.sortable({
                cursor:"move",
                handle: "td:first",
                update: function(event,ui) {
                    // Get the item ID"s in an array
                    var cids = Array.prototype.map.call(
                        $(\'[name="cid"]\'),
                        function (item) {
                            return item.value;
                        }
                    );

                    var ordering = Object.keys(cids);

                    $.ajax({
                        type: "POST",
                        url: "/index.php",
                        data: {
                            option: "com_careers",
                            task: "saveOrderAjax",
                            tmpl: "component",
                            cid: cids,
                            order: ordering
                        },
                        context: this,
                        success: function() {
                            $("#success-message").show().delay(1500).fadeOut(200);
                        }
                    })
                }
            });
            sortableList.disableSelection();
        });
    	// ]]>
		');

		parent::display($tpl);
	}

	public function order($rows, $image = 'filesave.png', $task = "saveorder")
	{
		$image = '<img src="' . JUri::base() . 'components/com_careers/assets/images/' . $image . '" alt="save order" />';
		return '<a href="javascript:saveorder('.(count( $rows )-1).', \''.$task.'\')" title="'.JText::_( 'Save Order' ).'">'.$image.'</a>';
	}
}
